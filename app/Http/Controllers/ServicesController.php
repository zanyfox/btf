<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;


class ServicesController extends Controller {


  public function pultovayaOhrana($slug = null) {
  
  	$parentService = Service::where(['slug' => 'pultovaya-ohrana', 'status' => true])->first();
  	
  	if($slug) {
  		$service = Service::where(['slug' => $slug, 'parent_id' => $parentService->id, 'status' => true])->first();
  		$siblings = Service::where(['parent_id' => $service->parent_id, 'status' => true])->where('id', '!=', $service->id)->get();
  		$view ='services.ohrana.pultovaya-ohrana.' . $service->slug;
  		return view($view, [
  			'parentService' => $parentService,
      		'service' => $service,
      		'siblings' => $siblings,
    	]);
  	} 
    
    $childs = Service::where(['parent_id' => $parentService->id, 'status' => true])->get();
  	
  	$view ='services.ohrana.pultovaya-ohrana.' . $parentService->slug;
  	return view($view, [
      'service' => $parentService,
      'childs' => $childs,
    ]);
    
  }
  
  public function ohranaObektov($slug = null) {
  
  	$parentService = Service::where(['slug' => 'ohrana-obektov', 'status' => true])->first();

  	if($slug) {
  		$service = Service::where(['slug' => $slug, 'parent_id' => $parentService->id, 'status' => true])->first();
  		$siblings = Service::where(['parent_id' => $service->parent_id, 'status' => true])->where('id', '!=', $service->id)->get();
  		$view ='services.ohrana.ohrana-obektov.' . $service->slug;
  		return view($view, [
  			'parentService' => $parentService,
      		'service' => $service,
      		'siblings' => $siblings,
    	]);
  	}
  	
  	$childs = Service::where(['parent_id' => $parentService->id, 'status' => true])->get();
  	
  	$view ='services.ohrana.ohrana-obektov.' . $parentService->slug;
  	return view($view, [
      'service' => $parentService,
      'childs' => $childs,
    ]);
  }
  
  public function ohranaOrganizatsiy($slug = null) {
  
  	$parentService = Service::where(['slug' => 'ohrana-organizatsiy', 'status' => true])->first();

  	if($slug) {
  		$service = Service::where(['slug' => $slug, 'parent_id' => $parentService->id, 'status' => true])->first();
  		$siblings = Service::where(['parent_id' => $service->parent_id, 'status' => true])->where('id', '!=', $service->id)->get();
  		$view ='services.ohrana.ohrana-organizatsiy.' . $service->slug;
  		return view($view, [
  			'parentService' => $parentService,
      		'service' => $service,
      		'siblings' => $siblings,
    	]);
  	}
  	
  	$childs = Service::where(['parent_id' => $parentService->id, 'status' => true])->get();
  	
  	$view ='services.ohrana.ohrana-organizatsiy.' . $parentService->slug;
  	return view($view, [
      'service' => $parentService,
      'childs' => $childs,
    ]);
  }
  
  public function fizicheskayaOhrana($slug = null) {
  
  	$parentService = Service::where(['slug' => 'fizicheskaya-ohrana', 'status' => true])->first();
  	
  	if($slug) {
  		$service = Service::where(['slug' => $slug, 'parent_id' => $parentService->id, 'status' => true])->first();
  		$siblings = Service::where(['parent_id' => $service->parent_id, 'status' => true])->where('id', '!=', $service->id)->get();
  		$view ='services.ohrana.fizicheskaya-ohrana.' . $service->slug;
  		return view($view, [
  			'parentService' => $parentService,
      		'service' => $service,
      		'siblings' => $siblings,
    	]);
  	} 
    
    $childs = Service::where(['parent_id' => $parentService->id, 'status' => true])->get();
  	
  	$view ='services.ohrana.fizicheskaya-ohrana.' . $parentService->slug;
  	return view($view, [
      'service' => $parentService,
      'childs' => $childs,
    ]);
    
  }
  
  public function okhrannyeSistemy($slug = null) {
  	
  	$parentService = Service::where(['slug' => 'okhrannye-sistemy', 'status' => true])->first();
  	if($slug) {
  		$service = Service::where(['slug' => $slug, 'parent_id' => $parentService->id, 'status' => true])->first();
  		$siblings = Service::where(['parent_id' => $service->parent_id, 'status' => true])->where('id', '!=', $service->id)->get();
  		$view ='services.ohrana.okhrannye-sistemy.' . $service->slug;
  		return view($view, [
  			'parentService' => $parentService,
      		'service' => $service,
      		'siblings' => $siblings,
    	]);
  	} 
    
    $childs = Service::where(['parent_id' => $parentService->id, 'status' => true])->get();
  	
  	$view ='services.ohrana.okhrannye-sistemy.' . $parentService->slug;
  	return view($view, [
      'service' => $parentService,
      'childs' => $childs,
    ]);
    
  }
  


  public function prochieUslugi($slug = null) {

    $parentService = Service::where(['slug' => 'prochie-uslugi', 'status' => true])->first();
  	if($slug) {
  		$service = Service::where(['slug' => $slug, 'parent_id' => $parentService->id, 'status' => true])->first();
  		$siblings = Service::where(['parent_id' => $service->parent_id, 'status' => true])->where('id', '!=', $service->id)->get();
  		$view ='services.prochie-uslugi.' . $service->slug;
  		return view($view, [
  			'parentService' => $parentService,
      		'service' => $service,
      		'siblings' => $siblings,
    	]);
  	} 
    
    $childs = Service::where(['parent_id' => $parentService->id, 'status' => true])->get();
  	
  	$view ='services.prochie-uslugi.' . $parentService->slug;
  	return view($view, [
      'service' => $parentService,
      'childs' => $childs,
    ]);

  }

  public function child($service) {

    
    $siblings = Service::where(['parent_id' => $service->parent_id, 'status' => true])->where('id', '!=', $service->id)->get();
    $childs = Service::where(['parent_id' => $service->id, 'status' => true])->get();
    
    
    if($service->parent_id == 28) {
      $parentSlug = 'other';
    }

    if($service->parent_id == 1) {
      $parentSlug = 'security';
    }

    //dd($service->slug);

    return view('services.' . $parentSlug . '.' . $service->slug . '.' . $service->slug, [
      'service' => $service,
      'siblings' => $siblings,
      'childs' => $childs 
    ]);
  }

  public function grandchild($service) {

    //dd($service->parent_id);

    //if( $service->parent_id == 3 || $service->parent_id == 4 ) {

      $siblings = Service::where(['parent_id' => $service->parent_id, 'status' => true])->where('id', '!=', $service->id)->get();
      
      if($service->parent_id == 2) {
        $parentSlug = 'remote-security';
      }

      if($service->parent_id == 3) {
        $parentSlug = 'physical-security';
      }

      if($service->parent_id == 4) {
        $parentSlug = 'security-systems';
      }

      if (view()->exists('services.security.' . $parentSlug . '.'.$service->slug)) {
        $view = 'services.security.' . $parentSlug . '.'.$service->slug;
      } else {
        $view = 'services.security.physical-security.physical-cargo-escort';
      }

      return view($view, [
        'service' => $service,
        'siblings' => $siblings,
      ]);
    //}

    /* $siblings = Service::where(['parent_id' => $service->parent_id, 'status' => true])->where('id', '!=', $service->id)->get();
    return view('services.grandchild', [
      'service' => $service,
      'siblings' => $siblings,
    ]); */
  }

}