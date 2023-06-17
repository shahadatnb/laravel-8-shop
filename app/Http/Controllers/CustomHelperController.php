<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Models\Menu;
use Carbon\Carbon;

class CustomHelperController
{

    public function settingAll(){
        if(class_exists('DB')){
            return Setting::where('category','basic')->pluck('value','name')->toArray();
        }
    }

    public function settingValue($col){
            return Setting::where('name',$col)->pluck('value')->first();
        }


    public function productLink($id){
        $product = Product::find($id);
        if($product->parent_id != null){
            $product = Product::find($product->parent_id);
        }
        return route('singleProduct',$product->id);
    }

    public function productThumb($product){
        $path = $product->thumbnail;
        if($path == ''){
            if($product->allphotos->first()) {
                $path = $product->allphotos->first()->path;
            }else{
                return '';
            }
        }
        return asset('storage/' . $path);
    }


    public function productThumbById($id){
        $product = Product::find($id);
        if($product->parent_id != null){
            $product = Product::find($product->parent_id);
        }
        return $this->productThumb($product);
    }

    public function products($arg1){
        $arg = [
            'take'=>20,
            'skip'=>0,
            'cat'=>[],
            'orderType'=>'DESC',
            'category'=>null,
            'single'=>false,
        ];

        $arg = array_merge($arg,$arg1);

        $post = Product::whereNull('parent_id')->where('status',1);      
        
        $post = $post->take($arg['take'])
        ->skip($arg['skip'])
        ->get();

        return $post;
    }

    public function posts($arg1){
        $arg = [
            'post_type'=>'post',
            'take'=>20,
            'skip'=>0,
            'cat'=>[],
            'orderBy'=>'id',
            'orderType'=>'ASC',
            'category'=>null,
            'single'=>false,
        ];

        $arg = array_merge($arg,$arg1);

        if($arg['cat']){
            $post = Post::whereHas('taxonomy', function($q) use ($arg){
                $q->whereIn('slug', $arg['cat']);
            })->where('status',1);
        }else{
            $post = Post::where('status',1);
        }        
        
        $post = $post->where('post_type',$arg['post_type'])
            ->orderBy($arg['orderBy'],$arg['orderType']);
        if($arg['single'] == true){
            $post = $post->first();
        }else{
            $post = $post->take($arg['take'])
            ->skip($arg['skip'])
            ->get();
        }
        return $post;
    }

    public function NaveMenuUrl($item, $linkClass, $extra=null){
        if($item->menuType == 'extrenal'):
            $url = $item->menu_url;
        /* elseif($item->menuType == 'page'):
            $url = url('/page').'/'.$item->menu_url; */
        elseif($item->menuType == 'home'):
            $url = url('/');
        else://($item->menuType == 'others'):
            $url = url('/').'/'.$item->menu_url;
        endif;

        return "<a class=\"{$linkClass}\" {$extra} href=\"{$url}\">{$item->lebel}</a>";
    }

    public function NaveMenu($menu_id, $arg1){
        $arg = [
            'menuClass'=>'',
            'listClass'=>'',
            'listParentClass'=>'',
            'listParentLinkClass'=>'',
            'subMenuClass'=>'',
            'linkClass'=>''
        ];

        $arg = array_merge($arg,$arg1);

        $menu = Menu::where('menu_id',$menu_id)->first();
        if($menu):
            $nav = "<ul class=\"{$arg['menuClass']}\">";
            foreach($menu->menuItem as $item){
                    if($item->subMenu->count()>0):
                        $nav .= "<li class=\"{$arg['listParentClass']} {$arg['listClass']} {$item->menu_class} \">". self::NaveMenuUrl($item, $arg['linkClass'].' '.$arg['listParentLinkClass'], 'data-bs-toggle="dropdown"');
                            $nav .= "<ul class=\"{$arg['subMenuClass']}\">";
                                foreach ($item->subMenu as $subItem):
                                    $nav .= "<li class=\"{$arg['listClass']} {$item->menu_class}\">" . self::NaveMenuUrl($subItem, $arg['linkClass']) .'</li>';
                                endforeach;
                            $nav .= '</ul>';
                        $nav .= '</li>';
                    else:
                        $nav .= "<li class=\"{$arg['listClass']} {$item->menu_class}\">" . self::NaveMenuUrl($item, $arg['linkClass']) . '</li>';
                    endif;
                }
            $nav .= '</ul>';
            return $nav;
        else:
            return '';
        endif;
    }

    function SocialMenu($menu_id){
        $menu = Menu::where('menu_id',$menu_id)->first();
        if($menu){
            return $menu->menuItem;
        }
    }


    public function nextDate($date){
        $date1 = Carbon::parse($date)->addDays(1);
        return $date1->toDateString();
    }

    public function preDate($date){
        $date1 = Carbon::parse($date)->addDays(-1);
        return $date1->toDateString();
    }

    public function prettyDate($date) {
        return date("M d Y", strtotime($date));
    }

    public function prettyDateTime($date) {
        //return date("d-m-Y h:i A", strtotime($date));
        return date("M d ,y | h:i A", strtotime($date));
    }

    public function prettyDateS($date) {
        return date("d/m", strtotime($date));
    }

    public function numberTowords($num = false)
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

    public function fileIcom($file){
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

    public function getShorterString($text, $length=null)
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
