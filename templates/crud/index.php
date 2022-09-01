<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header <?=config('theme')['panel_color']?>">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold"><?=_ucwords(__($table))?></h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data <?=_ucwords(__($table))?></h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <?php if(is_allowed(get_route_path('crud/create',['table'=>$table]),auth()->user->id)): ?>
                            <a href="<?=routeTo('crud/create',['table'=>$table])?>" class="btn btn-secondary btn-round">Buat <?=_ucwords(__($table))?></a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if($success_msg): ?>
                            <div class="alert alert-success"><?=$success_msg?></div>
                            <?php endif ?>
                            <div class="table-responsive table-hover table-sales">
                                <table class="table datatable-crud">
                                    <thead>
                                        <tr>
                                            <th width="20px">#</th>
                                            <?php 
                                            foreach($fields as $field): 
                                                $label = $field;
                                                if(is_array($field))
                                                {
                                                    $label = $field['label'];
                                                }
                                                $label = _ucwords($label);
                                            ?>
                                            <th><?=$label?></th>
                                            <?php endforeach ?>
                                            <th class="text-right">
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>