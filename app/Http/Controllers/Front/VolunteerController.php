<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;
use App\Services\CVParsingService;
use Smalot\PdfParser\Parser as PdfParser;
use PhpOffice\PhpWord\IOFactory as PhpWordIOFactory;

class VolunteerController extends Controller
{
    private $cvParsingService;

    public function __construct(CVParsingService $cvParsingService)
    {
        $this->cvParsingService = $cvParsingService;
    }

    public function index()
    {
        $volunteers = Volunteer::paginate(20);
        return view('front.volunteers', compact('volunteers'));
    }

    public function detail($id)
    {
        $volunteer = Volunteer::findOrFail($id); // Use findOrFail for proper error handling
        return view('front.volunteer', compact('volunteer'));
    }

    public function uploadCV(Request $request)
    {
        // Validate the CV file
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx',
        ]);

        // Store the uploaded CV file
        $cvPath = $request->file('cv')->store('uploads/cvs');
        $cvFullPath = storage_path('app/'.$cvPath);

        // Extract data from the uploaded CV file
        $text = $this->extractTextFromCV($cvFullPath, $request->file('cv')->getClientOriginalExtension());

        // Extract specific fields from the CV content using the service
        $phone = $this->cvParsingService->extractSection($text, 'phone');
        // Ensure phone number starts with +855
        $phone = $phone ? '+855' . ltrim($phone, '+') : null;

        // Extract specific fields from the CV content using the service
        $volunteerData = [
            'phone' => $phone,
            'address' => $this->cvParsingService->extractSection($text, 'address'),
            'date_of_birth' => $this->cvParsingService->extractSection($text, 'date_of_birth'),
            'profession' => 'volunteer',
            'skills' => $this->cvParsingService->extractSection($text, 'skills'),
            'experience' => $this->cvParsingService->extractSection($text, 'experience'),
            'education' => $this->cvParsingService->extractSection($text, 'education'),
            'facebook' => $this->cvParsingService->extractSection($text, 'facebook'),
            'twitter' => $this->cvParsingService->extractSection($text, 'twitter'),
            'linkedin' => $this->cvParsingService->extractSection($text, 'linkedin'),
            'instagram' => $this->cvParsingService->extractSection($text, 'instagram'),
            'website' => $this->cvParsingService->extractSection($text, 'website'),
            'github' => $this->cvParsingService->extractSection($text, 'github'),
            'volunteer_interest' => $this->cvParsingService->extractSection($text, 'volunteer_interest'),
            'availability' => $this->cvParsingService->extractSection($text, 'availability'),
            'previous_volunteering_experience' => $this->cvParsingService->extractSection($text, 'previous_volunteering_experience'),
            'detail' => $this->cvParsingService->extractSection($text, 'detail'),
            'languages_spoken' => $this->cvParsingService->extractSection($text, 'languages_spoken'),
            'emergency_contact' => $this->cvParsingService->extractSection($text, 'emergency_contact'),
            'cv_file' => $cvPath,
            'status' => 'pending',
        ];

        // Create or update volunteer record
        $volunteer = Volunteer::updateOrCreate(
            ['user_id' => Auth::id()],
            array_merge($volunteerData, [
                'user_id' => Auth::id(),
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'date_of_birth' => $volunteerData['date_of_birth'] ? date('Y-m-d', strtotime($volunteerData['date_of_birth'])) : null,
            ])
        );

        return redirect()->back()->with('success', 'Your CV has been uploaded successfully. We will review it and contact you.');
    }

    /**
     * Extract text from the uploaded CV file.
     *
     * @param string $filePath
     * @param string $extension
     * @return string
     */
    private function extractTextFromCV(string $filePath, string $extension): string
    {
        $text = '';

        if ($extension === 'pdf') {
            // PDF Parsing
            $parser = new PdfParser(); // Ensure you have Smalot/PdfParser installed
            $pdf = $parser->parseFile($filePath);
            $text = $pdf->getText();
        } elseif ($extension === 'doc' || $extension === 'docx') {
            // DOCX Parsing using PHPWord
            $phpWord = PhpWordIOFactory::load($filePath);
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    // Handle TextRun objects
                    if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                        foreach ($element->getElements() as $textElement) {
                            // Handle Text elements within TextRun
                            if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                $text .= $textElement->getText() . "\n";
                            }
                        }
                    }
                    // Handle direct Text objects outside TextRun
                    elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                        $text .= $element->getText() . "\n";
                    }
                }
            }
        }

        return $this->normalizeText($text);
    }


    /**
     * Normalize and clean the text.
     *
     * @param string $text
     * @return string
     */
    private function normalizeText(string $text): string
    {
        return strtolower(trim(preg_replace('/\s+/', ' ', $text)));
    }
}
