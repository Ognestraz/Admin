<form class="ajax" action="<?=URL::to('/')."/admin/menu_item".($menu->id ? '/'.$menu->id : '')?>" method="POST"> 
    <? if ($menu->id) { ?>
       <input type="hidden" name="id" value="<?=$menu->id?>" /> 
       <input type="hidden" name="_method" value="PUT" />
    <? } ?>

   <a href="#tabs-1"><?=$menu->name?></a></li>
   <input type="submit" class="btn" value="Принять" />    
</form>