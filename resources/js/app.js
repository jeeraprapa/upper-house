import './bootstrap';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import lightGallery from 'lightgallery'

// plugins (เลือกใช้ตามต้องการ)
import lgThumbnail from 'lightgallery/plugins/thumbnail'
import lgZoom from 'lightgallery/plugins/zoom'
import lgFullscreen from 'lightgallery/plugins/fullscreen'

import 'lightgallery/css/lightgallery.css'
import 'lightgallery/css/lg-zoom.css'

document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('eventGallery')
    if (!el) return

    const lg = lightGallery(el, {
        selector: '.gallery-item',
        plugins: [lgZoom, lgFullscreen],
        speed: 400,

        // ให้เหมือนในรูป: มีปุ่มปิด + ลูกศร
        closable: true,
        controls: true,
        counter: false,

        // เราจะทำปุ่มเองด้านล่าง
        download: false,

        // สำคัญ: แสดง subHtml ด้านล่างภาพ
        appendSubHtmlTo: '.lg-sub-html',

        addClass: 'lg-event-theme',
    })

    // ดักคลิกปุ่มใน caption (เพราะปุ่มอยู่ใน overlay)
    document.addEventListener('click', async (e) => {
        const btn = e.target.closest('[data-action]')
        if (!btn) return

        const action = btn.dataset.action

        if (action === 'save-one') {
            // const imageId = btn.dataset.id
            // รูปที่กำลังแสดงอยู่ใน lightbox
            const currentImg =
                document.querySelector('.lg-current .lg-object') // <img> หรือ <video>
                || document.querySelector('.lg-current .lg-image img')

            if (!currentImg) return

            // บางธีมใช้ src, บางทีเป็น data-src
            const imageUrl =
                currentImg.getAttribute('src')
                || currentImg.getAttribute('data-src')

            if (!imageUrl) return

            // ดาวน์โหลดแบบปลอดภัย (แนะนำ)
            const res = await fetch(imageUrl)
            const blob = await res.blob()
            const url = URL.createObjectURL(blob)

            const a = document.createElement('a')
            a.href = url
            a.download = (new URL(imageUrl, location.href)).pathname.split('/').pop() || 'image.jpg'
            document.body.appendChild(a)
            a.click()
            a.remove()
            URL.revokeObjectURL(url)
        }
    })
})
