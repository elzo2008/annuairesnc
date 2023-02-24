<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Entity\Tache;


class ExcelController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/upload-excel", name="home")
     */
    public function index(Request $request): Response
    {
        return $this->render('excel/index.html.twig', [
            'controller_name' => 'ExcelController',
        ]);
    }

    public function getData(): array
    {
        /**
         * @var 
         */
        $list = [];
        $taches = $this->entityManager->getRepository(Tache::class)->findAll();

        foreach($taches as $tache){
            $list[] = [
                $tache->getCreatedAt(),
                $tache->getDescription(),
                $tache->getDateExecution(),
                $tache->getEmploye(),
                $tache->getDateExecution(),
                $tache->getStatut(),
                $tache->getCommentaire()

            ];
        }
        return $list;
    }

    /**
     * @Route("/export", name="export")
     */ 
    public function export(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setTitle('Liste des taches');

        //Coloriage A1-F1 en Jaune
        $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
        $sheet->getStyle('B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
        $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
        $sheet->getStyle('D1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
        $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
        $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
        $sheet->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');

        $sheet->getCell('A1')->setValue('Date de creation');
        $sheet->getCell('B1')->setValue('Description de la tache');
        $sheet->getCell('C1')->setValue('Date execution');
        $sheet->getCell('D1')->setValue('Destinataire');
        $sheet->getCell('E1')->setValue('Date Execution');
        $sheet->getCell('F1')->setValue('Statut de la tache');
        $sheet->getCell('G1')->setValue('Commentaire');

        //Increase row cursor after header write
        $sheet->fromArray($this->getData(), null, 'A2', true);

        $writer = new Xlsx($spreadsheet);
        $filename = 'Taches IT.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachement;filename=' . $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

        return $this->redirectToRoute('home');
    }
}
