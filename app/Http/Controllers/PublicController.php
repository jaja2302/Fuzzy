<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stunting;
use App\Models\Wilayah;

class PublicController extends Controller
{
    public function results()
    {
        // Get sample results for demonstration
        // In a real application, you might want to show actual results
        $results = collect([
            (object) [
                'period' => 'January 2024',
                'actual_value' => 75.2,
                'predicted_value' => 73.8,
                'error' => 1.4,
                'accuracy' => 98.1
            ],
            (object) [
                'period' => 'February 2024',
                'actual_value' => 78.5,
                'predicted_value' => 76.9,
                'error' => 1.6,
                'accuracy' => 98.0
            ],
            (object) [
                'period' => 'March 2024',
                'actual_value' => 82.1,
                'predicted_value' => 80.3,
                'error' => 1.8,
                'accuracy' => 97.8
            ],
            (object) [
                'period' => 'April 2024',
                'actual_value' => 79.8,
                'predicted_value' => 78.5,
                'error' => 1.3,
                'accuracy' => 98.4
            ],
            (object) [
                'period' => 'May 2024',
                'actual_value' => 85.2,
                'predicted_value' => 83.7,
                'error' => 1.5,
                'accuracy' => 98.2
            ]
        ]);

        return view('public.results', compact('results'));
    }

    public function stuntingData()
    {
        // Get sample stunting data for demonstration
        $stuntingData = collect([
            (object) [
                'region' => 'Jakarta Pusat',
                'total_cases' => 1250,
                'prevalence_rate' => 12.5,
                'severe_cases' => 89,
                'moderate_cases' => 456,
                'mild_cases' => 705,
                'trend' => 'decreasing'
            ],
            (object) [
                'region' => 'Jakarta Selatan',
                'total_cases' => 2340,
                'prevalence_rate' => 15.2,
                'severe_cases' => 156,
                'moderate_cases' => 789,
                'mild_cases' => 1395,
                'trend' => 'stable'
            ],
            (object) [
                'region' => 'Jakarta Barat',
                'total_cases' => 2890,
                'prevalence_rate' => 18.7,
                'severe_cases' => 234,
                'moderate_cases' => 987,
                'mild_cases' => 1669,
                'trend' => 'increasing'
            ],
            (object) [
                'region' => 'Jakarta Timur',
                'total_cases' => 3456,
                'prevalence_rate' => 22.1,
                'severe_cases' => 345,
                'moderate_cases' => 1234,
                'mild_cases' => 1877,
                'trend' => 'increasing'
            ],
            (object) [
                'region' => 'Jakarta Utara',
                'total_cases' => 1890,
                'prevalence_rate' => 16.8,
                'severe_cases' => 123,
                'moderate_cases' => 678,
                'mild_cases' => 1089,
                'trend' => 'decreasing'
            ]
        ]);

        return view('public.stunting-data', compact('stuntingData'));
    }

    public function wilayahData()
    {
        // Get sample regional data for demonstration
        $wilayahData = collect([
            (object) [
                'name' => 'Jakarta Pusat',
                'population' => 1056896,
                'area' => 48.13,
                'density' => 21956,
                'healthcare_facilities' => 45,
                'education_level' => 'High',
                'infrastructure_quality' => 'Excellent'
            ],
            (object) [
                'name' => 'Jakarta Selatan',
                'population' => 2226544,
                'area' => 141.27,
                'density' => 15756,
                'healthcare_facilities' => 32,
                'education_level' => 'Medium',
                'infrastructure_quality' => 'Good'
            ],
            (object) [
                'name' => 'Jakarta Barat',
                'population' => 2434511,
                'area' => 129.54,
                'density' => 18799,
                'healthcare_facilities' => 28,
                'education_level' => 'Medium',
                'infrastructure_quality' => 'Good'
            ],
            (object) [
                'name' => 'Jakarta Timur',
                'population' => 2843816,
                'area' => 187.73,
                'density' => 15154,
                'healthcare_facilities' => 22,
                'education_level' => 'Medium',
                'infrastructure_quality' => 'Fair'
            ],
            (object) [
                'name' => 'Jakarta Utara',
                'population' => 1747315,
                'area' => 146.66,
                'density' => 11916,
                'healthcare_facilities' => 35,
                'education_level' => 'High',
                'infrastructure_quality' => 'Good'
            ]
        ]);

        return view('public.wilayah-data', compact('wilayahData'));
    }
}
