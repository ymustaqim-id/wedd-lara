<?php

namespace App;

use Cache;
use Laratrust\Laratrust;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class ShowMenu
{
  protected $items;

  public function __construct(){

  }

  public static function menu(){
    $menu = new ShowMenu();
    return $menu;
  }

  public function get($idParent=null){
    return Menu::where('parent_id','=',$idParent)->get();
  }

  public function render(){
    $html = "";

    $listMenu = $this->get();


      foreach($listMenu as $menu){
        if(\Laratrust::can($menu->permission->name)){
          $html .= $this->getHtmlMenu($menu);
          $listSubMenu = $this->get($menu->id);
          foreach($listSubMenu as $subMenu){
            if(\Laratrust::can($subMenu->permission->name)){
              $html .= $this->getHtmlMenu($subMenu);
              $listSubSubMenu = $this->get($subMenu->id);
              foreach($listSubSubMenu as $subSubMenu){
                if(\Laratrust::can($subSubMenu->permission->name)){
                  $html .= $this->getHtmlMenu($subSubMenu);
                }
              }
              if ($subMenu->parent_status == 'Y') {
                $html.='   </ul></li>';
              }
            }
          }
          if ($menu->parent_status == 'Y') {
            $html.='   </ul></li>';
          }
        }
    }

    return $html;
  }

  public function getHtmlMenu($menu){
    $hasSub = ($menu->parent_status == 'Y')?'has-sub':'';
    $menuUrl = ($menu->parent_status == 'Y')?'javascript:;':url($menu->url);
    $html ='<li class="site-menu-item '.$hasSub.'">
    <a href="'.$menuUrl.'">';
    if ($menu->ordinal == 1) {
      $html .='<i class="site-menu-icon '.$menu->icon.'" aria-hidden="true"></i>';
    }
    $html .='
      <span class="site-menu-title">'.$menu->name.'</span>';
    if ($menu->parent_status == 'Y') {
      $html .= '<span class="site-menu-arrow"></span>';
    }
    $html .='</a>';
    if ($menu->parent_status == 'Y') {
      $html .= '<ul class="site-menu-sub">';
    }

    return $html;
  }

  public function setCache(){
    Cache::put('user_menu_'.Auth::id(),$this->render(),120);
  }

  public function getCache(){
    $value = Cache::remember('user_menu_'.Auth::id(),120, function(){
            return $this->render();
    });

    return $value;
  }

  public function clearCache(){
    Cache::forget('user_menu_'.Auth::id());
  }

}
