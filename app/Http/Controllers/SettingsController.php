<?php

namespace App\Http\Controllers;

use App\Theme;
use Request;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    const MAX_PAGINATE = 10;
    const MAX_MORE_PAGINATE = 15;
    const COMMON_PLACEHOLDER_IMAGE = 'images/common-placeholder.jpg';

    public static function getExcerpt($str, $startPos=0, $maxLength=100)
    {
      	if(strlen($str) > $maxLength)
        {
      		$excerpt   = substr($str, $startPos, $maxLength-3);
      		$lastSpace = strrpos($excerpt, ' ');
      		$excerpt   = substr($excerpt, 0, $lastSpace);
      		$excerpt  .= '...';
      	}
        else
        {
      		$excerpt = $str;
      	}

      	return $excerpt;
    }

    public function getHeroimage()
    {
    	$image = Theme::where('type','heroimage')->value('content_link');

    	return view('userview.settings.heroimage',compact('image'));
    }

    public function postHeroimage()
    {
    	$image = Request::file('image');

    	if(empty($image))
    	{
    		return redirect('settings/heroimage');
    	}
    	else
    	{
	    	$path = 'images/settings/'; //need relative path, not absolute
	        $image_name = time() . $image->getClientOriginalName();
	        $image_path = $path . $image_name;
	        Image::make($image)->resize(null, 740)->save($image_path);

	    	$exists = Theme::where('type','heroimage')->first();

	    	if(!$exists)
	    	{
	    		Theme::insert([
	    				'type' 			     => 'heroimage',
	    				'content_link'	  => $image_path
	    			]);
	    	}
	    	else
	    	{
	    		Theme::where('type','heroimage')
	    			->update([
	    				'content_link'	=> $image_path
	    			]);
	    	}

	    	return redirect('settings/heroimage')->with('success', 'Brand Image Saved Successfully');
	    }
    }

    public function getVideos()
    {
    	$videos = Theme::where('type','video')->get();

    	$videolink = array();
      
    	foreach ($videos as $video)
    	{
    		array_push($videolink, $video->content_link);
    	}

    	if(count($videolink)<=0)
    	{
    		$videolink = array_fill(0,4,"");
    	}

    	return view('userview.settings.videos',compact('videos','videolink'));
    }


    public function postVideos()
    {
    	$input = Request::all();

    	$video1 = str_replace("watch?v=", "embed/", $input['video1']);
    	$video2 = str_replace("watch?v=", "embed/", $input['video2']);
    	$video3 = str_replace("watch?v=", "embed/", $input['video3']);
    	$video4 = str_replace("watch?v=", "embed/", $input['video4']);

    	$exists = Theme::where('type','video')->first();

    	if($exists)
    	{
    		Theme::where('type','video')->delete();
    	}

    	Theme::insert([
    				['type' 			=> 'video', 'content_link'	=> $video1],
    				['type' 			=> 'video', 'content_link'	=> $video2],
    				['type' 			=> 'video', 'content_link'	=> $video3],
    				['type' 			=> 'video', 'content_link'	=> $video4]
    			]);

    	return redirect('settings/videos')->with('success', 'Videos Saved Successfully');
    }

    public function getAdvertisement()
    {

    	return view('userview.settings.advertisement',compact('advertisements'));
    }

    public function getSocial()
    {
      $email = Theme::where('type','email')->value('content_link');
      $facebook = Theme::where('type','facebook')->value('content_link');
      $googleplus = Theme::where('type','googleplus')->value('content_link');
      $twitter = Theme::where('type','twitter')->value('content_link');
      $linkedin = Theme::where('type','linkedin')->value('content_link');

    	return view('userview.settings.social',compact('email','facebook','googleplus','twitter','linkedin'));
    }

    public function postSocial()
    {
    	$input = Request::all();

    	$email = $input['email'];
      $facebook = $input['facebook'];
      $googleplus = $input['googleplus'];
      $twitter = $input['twitter'];
      $linkedin = $input['linkedin'];

    	$exists = Theme::where('type','video')->first();

    	if(Theme::where('type','email')->first())
    	{
    		Theme::where('type','email')->update(['content_link' => $email]);
    	}
      else{
        Theme::insert(['type' => 'email','content_link' => $email]);
      }

      if(Theme::where('type','facebook')->first())
    	{
    		Theme::where('type','facebook')->update(['content_link' => $facebook]);
    	}
      else{
        Theme::insert(['type' => 'facebook','content_link' => $facebook]);
      }

      if(Theme::where('type','twitter')->first())
    	{
    		Theme::where('type','twitter')->update(['content_link' => $twitter]);
    	}
      else{
        Theme::insert(['type' => 'twitter','content_link' => $twitter]);
      }

      if(Theme::where('type','googleplus')->first())
    	{
    		Theme::where('type','googleplus')->update(['content_link' => $googleplus]);
    	}
      else{
        Theme::insert(['type' => 'googleplus','content_link' => $googleplus]);
      }

      if(Theme::where('type','linkedin')->first())
    	{
    		Theme::where('type','linkedin')->update(['content_link' => $linkedin]);
    	}
      else{
        Theme::insert(['type' => 'linkedin','content_link' => $linkedin]);
      }

    	return redirect('settings/social')->with('success', 'Social settings Saved Successfully');
    }

}
