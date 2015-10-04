<li data-id="<?=$file->id?>" class="list-group-item item">
    <img src="<?=$file->preview?>" class="file" />
    <?=$file->name?>
    <a href="<?=URL::to('/')?>/admin/file/act/<?=$file->id?>" class="act ajax">
        <img src="<?=URL::to('/')?>/assets/images/checkbox_<?=($file->act ? 'full' : 'empty')?>.png">
    </a>
    <a href="<?=URL::to('/')?>/admin/file/<?=$file->id?>/edit" class="edit ajax-modal" data-target="#subModal">
        <img src="<?=URL::to('/')?>/assets/images/edit.png">
    </a>
    <a href="<?=URL::to('/')?>/admin/file/<?=$file->id?>" class="ajax delete">
        <img src="<?=URL::to('/')?>/assets/images/delete.png">
    </a>
    <a href="<?=$file->url . (stripos($file->url, 'vk.com') !== false ? '&iframe=true' : '')?>" rel="prettyPhoto" class="zoom">
        <img src="<?=URL::to('/')?>/assets/images/zoom.png">
    </a>
</li>