<?php

return [

    'medications' => 'Medications',
    'medication' => 'Medication',
    'btn_add_medication' => 'Add Medication',

    'name' => 'Medication Name',
    'case_type' => 'Case Type',
    'dosage' => 'Dosage',
    'instructions' => 'Instructions',
    'medication_taken' => 'Medication Dispensing Status',
    'has_alternative' => 'Has Alternative',

    'departments' => 'Departments',

    'date' => 'Prescription Date',
    'time' => 'Prescription Time',

    'dispensed' => 'Dispensed',
    'undispensed' => 'Not Dispensed',

    'taken' => 'Taken',
    'not_taken' => 'Not Taken',

    //validation
    'department.required' => 'Department selection is required.',
    'department.exists' => 'This department does not exist.',
    'case_type.required' => 'Case type selection is required.',
    'case_type.exists' => 'This case type does not exist.',
    'name.required' => 'Medication name is required.',
    'name.string' => 'Medication name must be a string.',
    'name.min' => 'Medication name must be at least :min characters.',
    'name.max' => 'Medication name must not exceed :max characters.',
    'name.unique' => 'This medication name has already been taken.',
    'dosage.required' => 'Dosage is required.',
    'dosage.string' => 'Dosage must be a string.',
    'dosage.max' => 'Dosage must not exceed :max characters.',
    'instructions.required' => 'Instructions are required.',
    'instructions.string' => 'Instructions must be a string.',
    'instructions.max' => 'Instructions must not exceed :max characters.',
    'medication_taken.required' => 'Medication dispensing status selection is required.',
    'has_alternative.required' => 'Alternative status selection is required.',

];
