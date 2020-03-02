<?php

return [

	'sections'     => [
		'general'   => "General informations",
		'details'   => "Job details",
		'main'      => "Body of the ad",
		'publisher' => "Contact person",
	],

	'labels'       => [
		'title'              => "Title",
		'category_id'        => "Category",
		'place'              => "Workplace",
		'description'        => "Description",

		'starts_at'          => "Start date",
		'ends_at'            => "End date",
		'duration'           => "Availability required",
		'salary'             => "Salary",
		'skills'             => "Skills",
		'languages'          => "Language·s",

		'contact_first_name' => "First name",
		'contact_last_name'  => "Last name",
		'contact_email'      => "Email",
		'contact_phone'      => "Phone number",
		'section_ids' 	=> "Section",

		'ask_je'							=>'I want my request to be handled by the Junior Entreprise EPFL.'
	],

	'placeholders' => [
		'title'              => "Pizza delivery, Neuroscience experiment",
		'category_id'        => "",
		'place'              => "St-Sulpice, remotely",
		'description'        => "What kind of work is it? Are there any particular dispositions (schedule, team, prerequisite)?",

		'starts_at'          => "",
		'ends_at'            => "",
		'duration'           => "10h a week, 120h in total",
		'salary'             => "to discuss, 24.—/h",
		'skills'             => "3D modeling, Scala",
		'languages'          => "English, good french level is a plus",
		'section'						=>"Sections",

		'contact_first_name' => "Anne",
		'contact_last_name'  => "Onymous",
		'contact_email'      => "anne.onyme@epfl.ch",
		'contact_phone'      => "+41 21 69 XX XX",
	],
	'availability' => [
		'full_time' =>  "Full time",
		'beside' => "Besides studies",
		'weekends' => "Weekends",
		'holiday' => "Holiday",
		'other' => "Other",
	],
	'epfl_sections' => [
		'architecture' => "Architecture", 
		'chemistry' => "Chimie et Génie Chimique",
		'cms'=> "Cours de Mathématiques Spéciales",
		'civil'=>"Génie Civil",
		'meca' => "Génie Mécanique",
		'elec' => "Génie électrique et électronique", 
		'humanities' => "Humanités digitales", 
		'computer' => 'Informatique',
		'financial' => "Ingénierie Financière",
		'management' => "Management, technologie et entrepreneuriat",
		'mathematics' => "Mathématiques",
		'microengineering' => "Microtechnique",
		'physics' => "Pḧysique",
		'materials' => "Science et Génie des Matériaux",
		'environmental' => "Sciences et ingénierie de l’environnement", 
		'communication' => "Systèmes de Communication",
		'all' => "All"
	],
	'category' => [
		'home' => "Home help",
		'babysitting' => "Babysitting",
        'experiments' => "Experiments",
        'computer' => "Computer",
        'office' => "Office Job",
        'flyering' => "Flyering",
        'administrative' => "Administrative",
        'studies_experiments'=> 'Studies/experiments',
        'promotion' => "Promotion",
        'waiter_hospitality'=> "Waiter/Waitress/Hospitality",
        'tutoring' => "Tutoring",
        'other'=> "Others"
	]

];
