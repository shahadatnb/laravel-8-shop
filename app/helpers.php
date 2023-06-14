<?php
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use Carbon\Carbon;
//use Illuminate\Support\Str;

function settingAll(){
    if(class_exists('DB')){
        return Setting::where('category','basic')->pluck('value','name')->toArray();
    }
}
    
function settingValue($col){
        return Setting::where('name',$col)->pluck('value')->first();
    }


function nextDate($date){
    $date1 = Carbon::parse($date)->addDays(1);
    return $date1->toDateString();
}

function preDate($date){
    $date1 = Carbon::parse($date)->addDays(-1);
    return $date1->toDateString();
}


function prettyDate($date) {
    return date("M d Y", strtotime($date));
}

function prettyDateTime($date) {
    //return date("d-m-Y h:i A", strtotime($date));
    return date("M d ,y | h:i A", strtotime($date));
}

function prettyDateS($date) {
    return date("d/m", strtotime($date));
}

function numberTowords($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    $final = implode(' ', $words);
    return ucwords($final.' taka only.');
}

function fileIcom($file){
    $info = pathinfo(url('/public').'/upload/files/'.$file);
    $ext = $info['extension'];

    switch ($ext) {
    case 'pdf':
        return 'file-pdf-o';
        break;
    case 'doc':
        return 'file-word-o';
        break;
    case 'docx':
        return 'file-word-o';
        break;
    case 'xls':
        return 'file-excel-o';
        break;
    case 'xlsx':
        return 'file-excel-o';
        break;
    case 'ppt':
        return 'file-powerpoint-o';
        break;
    case 'pptx':
        return 'file-powerpoint-o';
        break;
    case 'zip':
        return 'file-zip-o';
        break;
    default:
        return 'file';
    }

}

if (!function_exists('getShorterString')) {
    function getShorterString($text, $length=null)
    {
        $formatedString = ucwords($text);

        if ($length != null) {
            if (strlen($formatedString) <= $length) {
                return $formatedString;
            } else {
                $y=substr($formatedString, 0, $length) . '...';
                return $y;
            }
        } else {
            return $formatedString;
        }
    }
}