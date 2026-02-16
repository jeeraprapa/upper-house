<?php

namespace App\Exports;

use App\Models\Questionnaire;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class QuestionnaireExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize
{
    public function query()
    {
        return Questionnaire::query()->latest();
    }

    public function headings(): array
    {
        return [
            'First name',
            'Last Name',
            'Email',
            'Contact Number',
            'Country of Residences',
            'Remark',
            'Registered date and time / consent time stamp',
        ];
    }

    public function map($q): array
    {
        return [
            $q->first_name,
            $q->last_name,
            $q->email,
            $q->contact_number,
            $q->country_of_residence,
            $q->remark,
            optional($q->created_at)->format('Y-m-d H:i:s'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = 'G';

        // 🔹 Header Style
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9D9D9'], // สีเทาแบบในภาพ
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // 🔹 ใส่เส้นขอบทุก cell
        $sheet->getStyle("A1:{$lastColumn}{$lastRow}")
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(Border::BORDER_THIN);

        // 🔹 Wrap text ช่อง Remark (คอลัมน์ F)
        $sheet->getStyle("F2:F{$lastRow}")
              ->getAlignment()
              ->setWrapText(true);

        return [];
    }
}
