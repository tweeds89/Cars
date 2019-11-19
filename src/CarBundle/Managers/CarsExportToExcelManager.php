<?php

namespace CarBundle\Managers;

use CarBundle\Repository\CarRepository;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/**
 * Class CarsExportToExcelManager
 * @package CarBundle\Managers
 */
class CarsExportToExcelManager
{
    /**
     * @var CarRepository $carRepository
     */
    protected $carRepository;

    /**
     * CarsExportToExcelManager constructor.
     * @param CarRepository $carRepository
     */
    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @param Worksheet $worksheet
     */
    protected function writeHeadersToWorksheet(Worksheet $worksheet): void
    {
        $headers = [
            "Marka",
            "Model",
            "Rok produkcji",
            "Paliwo",
        ];

        $currentPosition = 1;
        foreach ($headers as $header) {
            $worksheet->setCellValueByColumnAndRow($currentPosition, 1, $header);
            $worksheet->getColumnDimension(Coordinate::stringFromColumnIndex($currentPosition))->setAutoSize(true);
            $currentPosition++;
        }
    }

    /**
     * @param Worksheet $worksheet
     * @param array $cars
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    protected function fillWorksheetWithData(Worksheet $worksheet, array $cars): void
    {
        $worksheetRowIterator = 2;
        foreach ($cars as $car) {
            $worksheet->setCellValueByColumnAndRow(1, $worksheetRowIterator, $car->getCarBrand());
            $worksheet->setCellValueByColumnAndRow(2, $worksheetRowIterator, $car->getModel());
            $worksheet->setCellValueByColumnAndRow(3, $worksheetRowIterator, $car->getProductionYear());
            $worksheet->setCellValueByColumnAndRow(4, $worksheetRowIterator, $car->getFuelType());
            $worksheetRowIterator++;
        }

        $this->addStyling($worksheet, $worksheetRowIterator - 1);
    }

    /**
     * @param array $cars
     * @return Spreadsheet
     */
    public function createSpreadsheet(array $cars): Spreadsheet
    {
        try {
            $style = [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ];

            $spreadsheet = new Spreadsheet();
            $spreadsheet->getDefaultStyle()->applyFromArray($style);
            $worksheet = $spreadsheet->getActiveSheet();
            $this->writeHeadersToWorksheet($worksheet);
            $this->fillWorksheetWithData($worksheet, $cars);

            return $spreadsheet;
        } catch (Exception $e) {
            throw new \LogicException($e->getMessage());
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            throw new \LogicException($e->getMessage());
        }
    }

    /**
     * @param Worksheet $worksheet
     * @param int $lastRow
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function addStyling(Worksheet $worksheet, int $lastRow): void
    {
        $worksheet->getStyle('A1:D1')->applyFromArray([
           'borders' => [
               'allBorders' => [
                   'borderStyle' => Border::BORDER_MEDIUM
               ]
           ]
        ]);

        $worksheet->getStyle('A2:D' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ]);

        $worksheet->getStyle('A1:D1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A1:D1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $worksheet->getStyle('A1:D1')->getFont()->setBold(true);
        $worksheet->getRowDimension(1)->setRowHeight(40);
        $worksheet->setAutoFilter('A1:D' . $lastRow);
    }
}
