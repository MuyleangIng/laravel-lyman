<?php

namespace App\Services;

class CVParsingService
{
    private $keywordMapping = [
        // Basic Personal Information
        'name' => ['Name', 'Full Name', 'Applicant Name', 'Name of Applicant', 'Candidate Name'],
        'email' => ['Email', 'Email Address', 'Contact Email', 'Email ID', 'E-mail'],
        'phone' => ['Phone', 'Phone Number', 'Contact Number', 'Mobile', 'Cell'],
        'photo' => ['Photo', 'Profile Picture', 'Photograph', 'Headshot'],
        'address' => ['Address', 'Home Address', 'Residential Address', 'Current Address'],
        'date_of_birth' => ['Date of Birth', 'DOB', 'Birth Date', 'Date Born'],
        'profession' => ['Profession', 'Job Title', 'Occupation', 'Career Title', 'Current Role'],
        'skills' => [
            'Skills', 
            'Core Competencies', 
            'Technical Skills', 
            'Skills & Abilities', 
            'Expertise', 
            'Management Skills', 
            'Creativity', 
            'Adaptability', 
            'Negotiation', 
            'Critical Thinking', 
            'Leadership'
        ],
        'experience' => ['Experience', 'Work Experience', 'Professional Experience', 'Employment History', 'Career History'],
        'education' => ['Education', 'Academic Background', 'Qualifications', 'Degrees', 'Academic Qualifications', 'School', 'University', 'Institute', 'College'],
        'facebook' => ['Facebook', 'Facebook Profile', 'FB Profile'],
        'twitter' => ['Twitter', 'Twitter Handle', 'Twitter Account'],
        'linkedin' => ['LinkedIn', 'LinkedIn Profile', 'LinkedIn Account'],
        'instagram' => ['Instagram', 'Instagram Handle', 'IG Profile'],
        'website' => ['Website', 'Personal Website', 'Online Portfolio', 'Webpage'],
        'github' => ['GitHub', 'GitHub Profile', 'GitHub Account'],
        'volunteer_interest' => ['Volunteer Interest', 'Areas of Interest', 'Volunteer Preferences', 'Volunteer Goals'],
        'availability' => ['Availability', 'When Available', 'Availability Status', 'Work Availability'],
        'previous_volunteering_experience' => ['Previous Volunteering Experience', 'Past Volunteering', 'Volunteer History', 'Volunteer Experience'],
        'detail' => ['Detail', 'Additional Information', 'Further Details', 'Other Information'],
        'languages_spoken' => ['Languages Spoken', 'Language', 'Languages Known', 'Languages Proficient'],
        'emergency_contact' => ['Emergency Contact', 'Emergency Person', 'Emergency Contact Information', 'Contact in Case of Emergency'],
        'cv_file' => ['CV', 'Resume', 'Curriculum Vitae', 'Resume File', 'CV Document']
    ];

    // Define specific languages
    private $languages = ['Khmer', 'English', 'Chinese', 'French', 'Spanish', 'German', 'Japanese', 'Korean', 'Italian'];

    // Define specific skills
    private $skillsList = [
        'Expertise', 'Management Skills', 'Creativity', 'Adaptability', 
        'Negotiation', 'Critical Thinking', 'Leadership'
    ];

    // Define common Cambodian provinces and cities
    private $cambodianLocations = [
        'Phnom Penh', 'Siem Reap', 'Battambang', 'Kampong Cham', 'Kampong Chhnang', 
        'Kampong Speu', 'Kampong Thom', 'Kandal', 'Kep', 'Pailin', 
        'Preah Vihear', 'Prey Veng', 'Ratanakiri', 'Koh Kong', 'Mondulkiri',
        'Takeo', 'Svay Rieng', 'Tboung Khmum', 'Banteay Meanchey', 'Koh Kong'
    ];

    /**
     * Extract a section from the CV text based on the section name.
     *
     * @param string $text
     * @param string $sectionName
     * @return string|null
     */
    public function extractSection(string $text, string $sectionName): ?string
    {
        if ($sectionName === 'phone') {
            return $this->extractPhoneNumber($text);
        } 

        if ($sectionName === 'languages_spoken') {
            return $this->extractLanguages($text);
        }

        if ($sectionName === 'education') {
            return $this->extractEducation($text);
        }

        if ($sectionName === 'skills') {
            return $this->extractSkills($text);
        }

        if ($sectionName === 'address') {
            return $this->extractCurrentPlace($text);
        }

        if (!isset($this->keywordMapping[$sectionName])) {
            return null;
        }

        foreach ($this->keywordMapping[$sectionName] as $keyword) {
            // Ensure regex accounts for various possible formats and delimiters
            $pattern = "/$keyword\s*[:\-]?\s*(.*?)(?:\n\n|\n$|\Z)/is";
            if (preg_match($pattern, $text, $matches)) {
                return trim($matches[1]);
            }
        }
        return null;
    }

    /**
     * Extract languages spoken from the CV text.
     *
     * @param string $text
     * @return string|null
     */
    private function extractLanguages(string $text): ?string
    {
        $languagesSpoken = [];
        foreach ($this->languages as $language) {
            if (stripos($text, $language) !== false) {
                $languagesSpoken[] = $language;
            }
        }
        return $languagesSpoken ? implode(', ', $languagesSpoken) : null;
    }

    /**
     * Extract skills from the CV text.
     *
     * @param string $text
     * @return string|null
     */
    private function extractSkills(string $text): ?string
    {
        $skillsFound = [];
        foreach ($this->skillsList as $skill) {
            if (stripos($text, $skill) !== false) {
                $skillsFound[] = $skill;
            }
        }
        return $skillsFound ? implode(', ', $skillsFound) : null;
    }

    /**
     * Extract education information from the CV text.
     *
     * @param string $text
     * @return string|null
     */
    private function extractEducation(string $text): ?string
    {
        $educationDetails = [];
        $patterns = [
            "/(Bachelor|Master|Doctorate|PhD|Associate|Diploma|Certificate|Course)\s*[^:]*?\s*(\d{4} - \d{4})?\s*([^\n]*)\s*(?:\n|$)/i",
            "/(School|University|Institute|College)[^\n]*?:?\s*([^.\n]*)/i"
        ];

        foreach ($patterns as $pattern) {
            if (preg_match_all($pattern, $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $educationDetails[] = trim(implode(' ', array_slice($match, 1)));
                }
            }
        }

        return $educationDetails ? implode('; ', $educationDetails) : null;
    }

   /**
     * Extract the current place information from the CV text, ensuring only the first occurrence is captured.
     * It excludes any address after "Place of Birth".
     *
     * @param string $text
     * @return string|null
     */
    private function extractCurrentPlace(string $text): ?string
    {
        // Refine the split using a more robust pattern for "Place of Birth"
        $textBeforeBirthPlace = preg_split('/Place\s*of\s*Birth\s*[:\-]?\s*/i', $text)[0] ?? $text;

        // Extract common Cambodian locations from the part before "Place of Birth"
        foreach ($this->cambodianLocations as $location) {
            if (stripos($textBeforeBirthPlace, $location) !== false) {
                return $location;  // Return the first location found
            }
        }

        // Extract address components based on specific keywords from the part before "Place of Birth"
        foreach ($this->keywordMapping['address'] as $keyword) {
            $pattern = "/$keyword\s*[:\-]?\s*([^.\n]*)/i";
            if (preg_match($pattern, $textBeforeBirthPlace, $match)) {
                return trim($match[1]);  // Return the first address found
            }
        }

        return null;  // If no address or location is found
    }


    /**
     * Extract phone number from the CV text.
     * This method ensures that only the phone number is extracted, avoiding emails or other content.
     *
     * @param string $text
     * @return string|null
     */
    private function extractPhoneNumber(string $text): ?string
    {
        // Define a more specific phone number pattern allowing various formats but stopping before emails or other sections
        $pattern = "/\+?\d{1,3}?[-.\s]?\(?\d{1,4}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,9}(?!\s*[@\w])/";

        if (preg_match($pattern, $text, $matches)) {
            return trim($matches[0]);
        }

        return null;
    }


}
