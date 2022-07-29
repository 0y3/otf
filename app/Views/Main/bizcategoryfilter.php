<div class="col-md-2">
    <div class="filters shadow-sm rounded bg-white mb-4">
        <div class="filters-header border-bottom pl-4 pr-4 pt-3 pb-3">
            <h5 class="m-0">Filters</h5>
        </div>
        <div class="filters-body">
            <div id="accordion">
                
            <?php foreach ($biz->NestedCategories() as $cate) :?>
                <div class="filters-card border-bottom p-4">
                    <div class="filters-card-header" id="headingCategory">
                        <h6 class="mb-0">
                        <a href="#" class="btn-link text-black collapsed" data-toggle="collapse" data-target="#<?=$cate['slug']?>" aria-expanded="false" aria-controls="<?=$cate['slug']?>">
                        <?= esc(ucwords($cate['name']))?> <i class="icofont-arrow-down float-right"></i>
                        </a>
                        </h6>
                    </div>
                    <div id="<?=$cate['slug']?>" class="collapse" aria-labelledby="headingCategory" data-parent="#accordion" style="">
                        <div class="filters-card-body card-shop-filters">
                        <?php if($cate['menucount'] > 0 ): ?>
                            <div class="custom-control mt-1">
                                <a class="link" href="<?=site_url($biz->biz_type.'/'.$biz->slug.'/'.$cate['slug'])?>"><?= esc(ucwords($cate['name']))?> <small class="text-black-50"><?= $cate['menucount']?></small></a>
                            </div>
                        <?php endif; ?>
                        <?php foreach ($cate['children'] as $cate2) :?> 
                            <div class="custom-control mt-1">
                                <a class="link" href="<?=site_url($biz->biz_type.'/'.$biz->slug.'/'.$cate2['slug'])?>"><?= esc(ucwords($cate2['name']))?> <small class="text-black-50"><?= $cate2['menucount']?></small></a>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

                
            </div>
        </div>
    </div>
    
</div>