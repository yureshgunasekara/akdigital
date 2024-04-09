<?php

namespace App\Http\Controllers;

use App\Models\GeneratedContent;
use App\Models\MostUsedTemplate;
use App\Models\SavedCode;
use App\Models\SavedDocument;
use App\Models\SavedImage;
use App\Models\SpeechToText;
use App\Models\TextToSpeech;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function generatedContent($contentType)
    {
        $user = auth()->user();
        $count = GeneratedContent::where('user_id', $user->id)
            ->where('content_type', $contentType)
            ->get()->sum('content_count');
            
        return $count;
    }

    public function generatedContentMonthly($contentType)
    {
        $user = auth()->user();
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        $counts = GeneratedContent::where('user_id', $user->id)
            ->where('content_type', $contentType)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $monthlyCounts = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $formattedDate = $currentDate->format('d-m-Y');
            $count = 0;

            foreach ($counts as $item) {
                if ($item->generation_date === $formattedDate) {
                    $count = $item->content_count;
                    break;
                }
            }

            $monthlyCounts[$formattedDate] = $count;
            $currentDate->addDay();
        }

        return $monthlyCounts;
    }

    public function registeredUsersMonthly($type)
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        $counts = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('role', '!=', 'admin')
            ->whereHas('subscription_plan', function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $monthlyCounts = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $formattedDate = $currentDate->format('Y-m-d');
            $count = 0;

            foreach ($counts as $item) {
                if ($item->date === $formattedDate) {
                    $count = $item->count;
                    break;
                }
            }

            $monthlyCounts[$formattedDate] = $count;
            $currentDate->addDay();
        }

        return $monthlyCounts;
    }

    // User dashboard 
    public function index() 
    {
        try {
            $user = auth()->user();
            $generatedPrompts = 0;
            $savedDocuments = 0;

            $generatedCodes = $this->generatedContent('code');
            $generatedTexts = $this->generatedContent('text');
            $generatedImages = $this->generatedContent('image');
            $generatedSpeeches = $this->generatedContent('speech');
            $generatedTemplateContents = $this->generatedContent('template');

            $monthlyCodes = $this->generatedContentMonthly('code');
            $monthlyTexts = $this->generatedContentMonthly('text');
            $monthlyImages = $this->generatedContentMonthly('image');
            $monthlySpeeches = $this->generatedContentMonthly('speech');
            $monthlyTemplateContents = $this->generatedContentMonthly('template');

            $savedCodes = SavedCode::where('user_id', $user->id)->get()->count();
            $savedImages = SavedImage::where('user_id', $user->id)->get()->count();
            $savedTexts = SpeechToText::where('user_id', $user->id)->get()->count();
            $savedSpeeches = TextToSpeech::where('user_id', $user->id)->get()->count();
            $savedTemplateContents = SavedDocument::where('user_id', $user->id)->get()->count();

            $mostUsesTemplates = MostUsedTemplate::where('user_id', $user->id)
                ->with('template')
                ->orderBy('count', 'desc')
                ->take(8)->get();

            return Inertia::render(
                'Dashboard', 
                compact(
                    'generatedCodes', 
                    'generatedTexts', 
                    'generatedImages', 
                    'generatedSpeeches', 
                    'generatedTemplateContents', 
                    'savedCodes', 
                    'savedImages', 
                    'savedTexts', 
                    'savedSpeeches', 
                    'savedTemplateContents', 
                    'mostUsesTemplates',
                    'monthlyCodes',
                    'monthlyTexts',
                    'monthlyImages',
                    'monthlySpeeches',
                    'monthlyTemplateContents',
                )
            );
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    // Admin dashboard 
    public function admin_dashboard() 
    {
        try {
            $totalUsers = 0;
            $totalFreeUsers = 0;
            $totalStandardUsers = 0;
            $totalPremiumUsers = 0;

            $users = User::where('role', '!=', 'admin')->with('subscription_plan')->get();
            foreach ($users as $user) {
                $totalUsers++;
                if ($user->subscription_plan->type == 'Free') {
                   $totalFreeUsers++;
                } else if ($user->subscription_plan->type == 'Standard') {
                    $totalStandardUsers++;
                } else {
                    $totalPremiumUsers++;
                }   
            }
            
            $newUsers = 0;
            $proUsers = 0;
            $freeUsers = 0;
            
            $monthlyUsers = User::whereYear('created_at', '=', now()->year)
                ->whereMonth('created_at', '=', now()->month)
                ->get();
            foreach ($monthlyUsers as $user) {
                $newUsers++;
                if ($user->subscription_plan_id) {
                    $proUsers++;
                } else {
                    $freeUsers++;
                }
            }

            $recentUsers = User::where('role', '!=', 'admin')
                ->latest()
                ->limit(5)
                ->with('subscription_plan')
                ->get();

            $monthlyFreeUsers = $this->registeredUsersMonthly('Free');
            $monthlyStandardUsers = $this->registeredUsersMonthly('Standard');
            $monthlyPremiumUsers = $this->registeredUsersMonthly('Premium');

            return Inertia::render(
                'Admin/Dashboard', 
                compact(
                    'newUsers', 
                    'proUsers', 
                    'freeUsers', 
                    'recentUsers', 
                    'totalUsers', 
                    'totalFreeUsers', 
                    'totalStandardUsers', 
                    'totalPremiumUsers', 
                    'monthlyFreeUsers',
                    'monthlyStandardUsers',
                    'monthlyPremiumUsers',
                )
            );
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }
}
