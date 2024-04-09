<?php

namespace App\Helpers;

use App\Models\GeneratedContent;
use App\Models\SmtpSetting;
use App\Models\TokenCount;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;

class AppHelper
{
    public static function smtp()
    {
        $smtp = SmtpSetting::first();

        config(['mail.mailers.smtp.host' => $smtp->host]);
        config(['mail.mailers.smtp.port' => $smtp->port]);
        config(['mail.mailers.smtp.username' => $smtp->username]);
        config(['mail.mailers.smtp.password' => $smtp->password]);
        config(['mail.mailers.smtp.encryption' => $smtp->encryption]);
        config(['mail.from.address' => $smtp->sender_email]);
        config(['mail.from.name' => $smtp->sender_name]);

        return $smtp;
    }


    public static function user()
    {
        $id = auth()->user()->id;
        return User::where('id', $id)->with('subscription_plan')->first();
    }


    public static function today_content($contentType)
    {
        return GeneratedContent::where('user_id', self::user()->id)
            ->where('content_type', $contentType)
            ->where('generation_date', date('d-m-Y'))
            ->first();
    }

    public static function content_handler($todayContent, $contentType)
    {
        if ($todayContent) {
            $todayContent->content_count = $todayContent->content_count + 1;
            $todayContent->update();
        } else {
            $newPrompt = new GeneratedContent;
            $newPrompt->user_id = self::user()->id;
            $newPrompt->content_type = $contentType;
            $newPrompt->generation_date = date('d-m-Y');
            $newPrompt->save();
        }
    }


    public static function today_token()
    {
        return TokenCount::where('user_id', self::user()->id)
            ->where('count_date', date('d-m-Y'))
            ->first();
    }

    public static function token_handler($currentToken)
    {
        $todaysToken = self::today_token();
        if ($todaysToken) {
            $todaysToken->total_count = $todaysToken->total_count + $currentToken;
            $todaysToken->update();
        } else {
            $newToken = new TokenCount;
            $newToken->user_id = self::user()->id;
            $newToken->count_date = date('d-m-Y');
            $newToken->total_count = $currentToken;
            $newToken->save();
        }
    }


    public static function limit_checker($todaysContent, $contentType, $message)
    {
        if (self::user()->role == 'user' && $todaysContent) {
            $limit = self::user()->subscription_plan[$contentType];
            if ($limit != 'Unlimited' && (int) $limit <= $todaysContent->content_count) {
                return ['error' => "You have crossed $message generation limit for today!"];
            }
        }
        return false;
    }


    public static function token_checker($newToken)
    {
        $todaysToken = self::today_token();
        if (self::user()->role == 'user' && $todaysToken) {
            $tokenLength = (int) self::user()->subscription_plan->content_token_length;

            $leftToken = $tokenLength - $todaysToken->total_count;
            if ($tokenLength > $todaysToken->total_count && $leftToken < $newToken) {
                return ['warning' => "Your available token limit for today is $leftToken"];
            }

            if ($tokenLength <= $todaysToken->total_count) {
                return ['error' => 'You have crossed the max token limit for today!'];
            }
        }
        return false;
    }


    public static function left_token()
    {
        if (self::user()->role == 'admin') {
            return 1000;
        } else {
            $todaysToken = self::today_token();
            $tokenLength = (int) self::user()->subscription_plan->content_token_length;
            if ($todaysToken) {
                $length = $tokenLength - $todaysToken->total_count;

                return $length;
            } else {
                return $tokenLength;
            }
        }
    }


    public static function image_uploader($reqImage)
    {
        // $image->save($location.time().$req->branding->getClientOriginalName());
        $location = public_path('/upload/');
        $image = Image::make($reqImage);
        $filename = $reqImage->getClientOriginalName();
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $image->save($location . time() . '.' . $extension);
        $imgUrl = 'upload/' . $image->filename . '.' . $image->extension;

        return $imgUrl;
    }


    public static function exportToCSV($dataList, array $columns, string $filename)
    {
        $csvFileName = $filename . time() . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$csvFileName",
            'Filename' => $csvFileName,
        ];

        $output = fopen('php://output', 'w');
        fputcsv($output, $columns);

        foreach ($dataList as $data) {
            $row = [];
            foreach ($columns as $column) {
                $row[] = $data->{$column};
            }
            fputcsv($output, $row);
        }

        fclose($output);

        return $headers;
    }
}
