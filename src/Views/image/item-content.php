<li data-id="<?=$image->id?>" class="list-group-item item">
    <img src="<?=$image->src('icon')?>" class="image" />
    <?=$image->name?>
    <a href="<?=URL::to('/')?>/admin/image/act/<?=$image->id?>" class="act ajax">
        <img src="<?=URL::to('/')?>/assets/images/checkbox_<?=($image->act ? 'full' : 'empty')?>.png">
    </a>
    <a href="<?=URL::to('/')?>/admin/image/<?=$image->id?>/edit" class="edit ajax-modal" data-target="#subModal">
        <img src="<?=URL::to('/')?>/assets/images/edit.png">
    </a>
    <a href="<?=URL::to('/')?>/admin/image/<?=$image->id?>" class="ajax delete">
        <img src="<?=URL::to('/')?>/assets/images/delete.png">
    </a>
    <a href="<?=$image->src()?>" class="zoom add-content" data-view="image" data-id="<?=$image->id?>" data-site="<?=$image->imageable->id?>">
        <img src="<?=URL::to('/')?>/assets/images/zoom.png">
    </a>
</li>