
<?php $__env->startSection('style'); ?>
<style>
        .card-header-collapes {
            border: 1px solid gray;
            padding: 10px;
            border-radius: 4px;
        }
    
        #accordion_input {
            width: 100%;
        }
    
        .card-body {
            padding: 10px;
        }
    
    
    
        .inline-box {
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }
    
        .input-group-addon {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    
        .product-custom-field {
            max-width: 150px;
            display: inline-block;
            margin-top: 5px;
            margin-right: 5px;
        }
    
        .product-custom-field-min {
            max-width: 150px;
            display: inline-block;
            margin-top: 5px;
            margin-right: 5px;
        }
    
        .input-group-addon,
        .input-group-btn {
            width: 1%;
            white-space: nowrap;
            vertical-align: middle;
        }
    
        .input-group {
            position: relative;
            display: table;
            border-collapse: separate;
        }
    
        .input-group input {
            width: 100% !important;
        }
    
        .input-group .form-control,
        .input-group-addon,
        .input-group-btn {
            display: table-cell;
        }
    
        .btn-add-input {
            display: inline-block;
        }
    
        .p-l {
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
        }
    
        .p-r {
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
        }
    
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Product</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('products.index')); ?>">Products</a> </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Product Information</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('updateProduct')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-md-12">
                    <input type="hidden" name="pro_id"  value="<?php echo e($products[0]->pro_id); ?>">
                            <div class="form-group">
                                    <label for="example-select">Product Code <span class="req-fed">*</span></label>
                                    <input type="text"
                                        class="form-control <?php echo e($errors->has('productCode') ? 'is-invalid' : ''); ?>"
                                        name="productCode" value="<?php echo e($products[0]->pro_code); ?>" placeholder="Enter name..."  required>
                                </div>
                                <span class="req-fed">Remark* Don't use ( & ) in product code</span>
                                <div class="form-group">
                                    <label for="example-select">Select Product Category <span class="req-fed">*</span></label><br>
                                    
                                        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="checkbox" onclick="selectProductcategories(<?php echo e($sub->sub_pro_id); ?>)" class="custom-control-input" id="dataCate<?php echo e($sub->sub_pro_id); ?>" name="pro_categories[]"
                                                value="<?php echo e($sub->sub_pro_id); ?>" <?php echo e(in_array($sub->sub_pro_id, $arrProcate) ? 'checked':''); ?> >
                                            <label class="custom-control-label"  for="dataCate<?php echo e($sub->sub_pro_id); ?>"><?php echo e($sub->name); ?></label>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="form-group">
                                    <label for="example-select">Select Series <span class="req-fed">*</span></label>
                                    <select class="js-select2 form-control" id="SeriesId" name="Series" data-placeholder="Choose one.." required>
                                            <option></option>
                                        </select>    
                               </div>
                                <div class="form-group">
                                    <label class="d-block">Segment  <span class="req-fed">*</span></label>
                                        <?php 
                                        $check1 = false;
                                        $check2 = false;
                                        $check3  = false;
                                          foreach($cerpros as $item) { 
                                               if($item->certificate_id == 1){
                                                $check1 = true;
                                               }
                                               if($item->certificate_id == 2){
                                                $check2 = true;
                                               }
                                               if($item->certificate_id == 3){
                                                $check3 = true;
                                               }
                                          }
                                        ?>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="checkbox" class="custom-control-input" id="status_induc" name="status_certificate[]"
                                            value="1" <?php echo e($check1 ? 'checked' : ''); ?>>
                                        <label class="custom-control-label" for="status_induc">Industrial</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="checkbox" class="custom-control-input" id="status_medical" name="status_certificate[]"
                                            value="2" <?php echo e($check2 ? 'checked' : ''); ?>>
                                        <label class="custom-control-label" for="status_medical">Medical</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="checkbox" class="custom-control-input" id="status_residen" name="status_certificate[]"
                                            value="3" <?php echo e($check3 ? 'checked' : ''); ?>>
                                        <label class="custom-control-label" for="status_residen">Lighting & Signage</label>
                                    </div>
                                </div>
                             
                                <div class="form-group">
                                        <label>Dimension L</label>
                                        <label><span class="req-fed">Choice A: Use numeric value for simple display L x W x D. Choice B: Use HTML to display any free text and ignore dimensionW and dimensionD  </span></label>
                                        <input type="text" class="form-control" value="<?php echo e($products[0]->dimensionL); ?>"  name="dimensionL" placeholder="Enter ..." >
                                </div>
                                <div class="form-group">
                                        <label>Dimension W</label>
                                        <input type="text" class="form-control" value="<?php echo e($products[0]->dimensionW); ?>"  name="dimensionw" placeholder="Enter ..." >
                                </div>
                                <div class="form-group">
                                        <label>Dimension D</label>
                                        <input type="text" class="form-control"  value="<?php echo e($products[0]->dimensionD); ?>" name="dimensionD" placeholder="Enter ..." >
                                </div>
                                <div class="form-group">
                                        <label>Unit Weight <span style="color:red;">(kg only)</span></label>
                                        <input type="text" class="form-control" value="<?php echo e($products[0]->unit_weight); ?>"  name="unitWeight" placeholder="Enter ..." >
                                </div>
                                <div class="form-group">
                                        <label class="d-block">Status <span class="req-fed">*</span></label>
                                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                <input type="radio" class="custom-control-input" id="status_none" name="status_pro" value="1" <?php echo e(($products[0]->status_product == 1 ) ? 'checked' : ''); ?>  >
                                                <label class="custom-control-label" for="status_none">None</label>
                                            </div>
                                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                <input type="radio" class="custom-control-input" id="status_new" name="status_pro" value="2" <?php echo e(($products[0]->status_product == 2 ) ? 'checked' : ''); ?>>
                                                <label class="custom-control-label" for="status_new">NEW</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                <input type="radio" class="custom-control-input" id="status_update" name="status_pro" value="3"  <?php echo e(($products[0]->status_product == 3 ) ? 'checked' : ''); ?>>
                                                <label class="custom-control-label" for="status_update">UPDATED</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status_eol" name="status_pro" value="4" <?php echo e(($products[0]->status_product == 4 ) ? 'checked' : ''); ?> >
                                                    <label class="custom-control-label" for="status_eol">EOL</label>
                                                </div>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Tag</label>
                                      <select name="tag[]" class="form-control js-example-tags" data-placeholder="Enter tag.." multiple="multiple">
                                        <option></option>
                                        <?php $__currentLoopData = $products_input; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($pro->pro_code); ?>" <?php echo e(in_array($pro->pro_code,$arrtags)?'selected':''); ?>><?php echo e($pro->pro_code); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $arrtags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tag); ?>" <?php echo e(!in_array($tag,$proInarr)?'selected':''); ?>><?php echo e($tag); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                    </div>
                                        <div class="form-group">
                                            <label>Related Products</label>
                                            <select  id="relatePro" class="js-select2 form-control" name="relatePro[]" data-placeholder="Choose many.."  multiple>
                                                <option></option>
                                                 <?php $__currentLoopData = $products_input2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($pro->pro_id); ?>" <?php echo e(in_array($pro->pro_id,$product_related )?'selected':''); ?>><?php echo e($pro->pro_code); ?></option>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             </select>
                                        </div>
                                      
            
                                  
                             
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($loop->iteration == 1): ?>
                                <li class="nav-item">
                                    <a class="nav-link active" onclick="selectlang('<?php echo e($item->local); ?>')" href="#btabs-alt-static-<?php echo e($item->local); ?>"
                                        style="text-transform: capitalize;"><?php echo e($item->local); ?></a>
                                </li>
                                <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link " onclick="selectlang('<?php echo e($item->local); ?>')" href="#btabs-alt-static-<?php echo e($item->local); ?>"
                                        style="text-transform: capitalize;"><?php echo e($item->local); ?></a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                        <a class="nav-link " onclick="selectlang('<?php echo e($alang->name); ?>')" href="#btabs-alt-static-<?php echo e($alang->name); ?>"
                                            style="text-transform: capitalize;"><?php echo e($alang->name); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="block-content tab-content">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($item->local); ?>">
                                <?php if($loop->iteration == 1): ?>
                                <div class="tab-pane active" id="btabs-alt-static-<?php echo e($item->local); ?>" role="tabpanel">
                                  
                                    <div class="form-group">
                                        <label for="">Highlights & Features</label>
                                    <textarea name="overview[<?php echo e($item->local); ?>]" class="jsnotenew"><?php echo e($item->content_1); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Content</label>
                                        <textarea name="content[<?php echo e($item->local); ?>]" class="jsnotenew"><?php echo e($item->content_2); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Show/hide language</label>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status-0<?php echo e($item->local); ?>" name="status[<?php echo e($item->local); ?>]" value="1" <?php echo e(($item->showstatus == 1 ) ? 'checked' : ''); ?>>
                                                    <label class="custom-control-label" for="status-0<?php echo e($item->local); ?>">Show</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status-3<?php echo e($item->local); ?>" name="status[<?php echo e($item->local); ?>]" value="0" <?php echo e(($item->showstatus == 0 ) ? 'checked' : ''); ?> >
                                                    <label class="custom-control-label" for="status-3<?php echo e($item->local); ?>">Hide</label>
                                                </div>
                                           
                                        </div>
                                </div>
                                <?php else: ?>
                                <div class="tab-pane" id="btabs-alt-static-<?php echo e($item->local); ?>" role="tabpanel">
                                    <div class="form-group">
                                        <label for="">Highlights & Features</label>
                                        <textarea name="overview[<?php echo e($item->local); ?>]" class="jsnotenew"><?php echo e($item->content_1); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Content</label>
                                        <textarea name="content[<?php echo e($item->local); ?>]" class="jsnotenew"><?php echo e($item->content_2); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                           <label class="d-block">show/hide language</label>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status-1<?php echo e($item->local); ?>" name="status[<?php echo e($item->local); ?>]" value="1" <?php echo e(($item->showstatus == 1 ) ? 'checked' : ''); ?>  >
                                                    <label class="custom-control-label" for="status-1<?php echo e($item->local); ?>">Show</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status-2<?php echo e($item->local); ?>" name="status[<?php echo e($item->local); ?>]" value="0" <?php echo e(($item->showstatus == 0 ) ? 'checked' : ''); ?> >
                                                    <label class="custom-control-label" for="status-2<?php echo e($item->local); ?>">Hide</label>
                                                </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($alang->name); ?>">
                                <div class="tab-pane" id="btabs-alt-static-<?php echo e($alang->name); ?>" role="tabpanel">
                                        <div class="form-group">
                                            <label for="">Highlights & Features</label>
                                            <textarea name="overview[<?php echo e($alang->name); ?>]" class="jsnotenew"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Content</label>
                                            <textarea name="content[<?php echo e($alang->name); ?>]" class="jsnotenew"></textarea>
                                        </div>
                                        <div class="form-group">
                                                <label class="d-block">Show Status</label>
                                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                        <input type="radio" class="custom-control-input" id="status-1<?php echo e($alang->name); ?>" name="status[<?php echo e($alang->name); ?>]" value="1" checked >
                                                        <label class="custom-control-label" for="status-1<?php echo e($alang->name); ?>">Show</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                        <input type="radio" class="custom-control-input" id="status-2<?php echo e($item->local); ?>" name="status[<?php echo e($alang->name); ?>]" value="0">
                                                        <label class="custom-control-label" for="status-2<?php echo e($alang->name); ?>">Hide</label>
                                                    </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
             
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10px;">
                                            File Type
                                        </th>
                                        <th style="width: 300px;">Old Image</th>
                                        <th style="width: 300px;">Preview</th>
                                        <th>Upload File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            Thumbnail
                                        </td>
                                        <td class="font-w600">
                                            <img src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($products[0]->picture); ?>"
                                                class="img-thumbnail" alt="">
                                                <input type="hidden" value="<?php echo e($products[0]->picture); ?>" name="oldFile">
                                        </td>
                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/200x200.png"
                                                class="img-thumbnail imagePreview2" alt="">
                                        </td>
                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="thumbnail"
                                                    name="thumbnail" value="no image" accept="image/*">
                                                <label id="label2" class="custom-file-label" for="thumbnail">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="contenttdata"> 
                        </div>
                        <div class="col-md-12">
                        <div class="form-group mt-5">
                            <label class="d-block">Enable/Disable</label>
                            <div
                                class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input"
                                    id="status-cl1en" name="enable_pro" value="1"
                                     <?php echo e($products[0]->enable_pro == 1 ?'checked':''); ?>>
                                <label class="custom-control-label"
                                    for="status-cl1en">Enable</label>
                            </div>
                            <div
                                class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input"
                                    id="status-cl2en" name="enable_pro" value="0"  <?php echo e($products[0]->enable_pro == 0 ?'checked':''); ?>>
                                <label class="custom-control-label"
                                    for="status-cl2en">Disable</label>
                            </div>
                        </div>

                        <div class="form-group mt-5">
                            <label class="d-block">Is manaul page show?</label>
                            <div
                                class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input"
                                    id="status-manaul" name="manaul_status" value="1"
                                     <?php echo e($products[0]->manaul_page == 1 ?'checked':''); ?>>
                                <label class="custom-control-label"
                                    for="status-manaul">Show</label>
                            </div>
                            <div
                                class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input"
                                    id="status-manaul2" name="manaul_status" value="0"  <?php echo e($products[0]->manaul_page == 0 ?'checked':''); ?>>
                                <label class="custom-control-label"
                                    for="status-manaul2">Hide</label>
                            </div>
                        </div>
                        

                        </div>
                        <div class="form-group text-center mt-5">
                            <button class="btn btn-info" type="submit">Update
                            </button>
                            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
      
         $(".js-example-tags").select2({
          tags: true
         });
        
        $('.jssummernote').summernote({
          tabsize: 2,
          height: 200
        });
        $('.jssummernote1').summernote({
          tabsize: 2,
          height: 300
        });
       
        var section = <?= json_encode($section);?>;
        var property = <?= json_encode($propertys);?>;
        var feilds = <?= json_encode($pd_fields);?>;  
        var langInNotcontents  = <?= json_encode($language);?>;  
        var allLangs  = <?= json_encode($allLang);?>;
        var arrCate  = <?= json_encode($arrProcate);?>;
        
        
         function getHtmlContent(lang){
              var typearray = [];
            var html2 = '';
                  html2 += '<div id="accordion_input">';
                 $.each(section, function(index_section,sect){
                    html2 += '<div class="card">';
                    html2 += '<div class="card-header card-header-collapes" data-toggle="collapse"';
                    html2 += 'href="#collapseheader'+index_section +'">';
                    html2 +=  '<a class="card-link">';
                    html2 +=  sect['name'];
                    html2 += '</a></div>';
                    html2 += ' <div id="collapseheader'+index_section +'"';
                    html2 += 'class="collapse'+ ((index_section == 0)  ? "show" : " ") + '"';
                    html2 += ' data-parent="#accordion_input">';
                    html2 += '  <div class="card-body">';
                     $.each(property, function(index_property,proper){
                       if(sect['sectid'] == proper['section_id']){
                          if(proper['type'] == "text"){
                            html2 +=  '<div class="data-text '+((proper['local'] == lang)  ? "d-block" : "d-none")+ '">';
                            html2 += '<div class="form-group">';
                            html2 += '<label class="d-block">'+proper['field_name']+'</label>';
                            html2 += ' <input type="text" class="form-control" name="inputText['+proper['pd_field_id']+']['+proper['local']+']" value="'+proper['value_text']+'"> </div>';
                            html2 += ' </div>';
                            var checkdata = typearray.indexOf(proper['pd_field_id']);
                           if(checkdata == -1){
                            html2 +=  '<input type="hidden" class="form-control" name="productfieldText[]" value="'+proper['pd_field_id']+'">';
                            typearray.push(proper['pd_field_id']);
                            $.each(langInNotcontents, function(index_alang,alang){
                                html2 +=  '<div class="data-text '+((alang['name'] == lang)  ? "d-block" : "d-none")+ '">';
                                html2 += '<div class="form-group">';
                                html2 += '<label class="d-block">'+proper['field_name']+'</label>';
                                html2 += ' <input type="text" class="form-control" name="inputText['+proper['pd_field_id']+']['+alang['name']+']" value=" "> </div>';
                                html2 += ' </div>';
                            });
                           }
                         }else{
                      if(proper['local'] == 'en' ){
                        html2 +=  '<div class="data-number">';
                        html2 +=  ' <input type="hidden" class="form-control"';
                        html2 +=  ' name="productfieldNumbers[]" value="'+proper['pd_field_id']+'">'
                        html2 +=  '<div class="form-group">';
                        html2 +=  '<label class="d-block">'+proper['field_name']+'</label>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">';
                        html2 +=  '<input type="radio" class="custom-control-input" onchange="selectinputtype('+proper['pd_field_id']+',1);"';
                        html2 +=  'id="status_input_sig'+proper['pd_field_id']+'" name="status_input['+proper['pd_field_id']+']"';
                        html2 +=  'value="1"  '+ ((proper['status_input'] == 1)  ? "checked" : " ") + '>';
                        html2 +=  '<label class="custom-control-label"for="status_input_sig'+proper['pd_field_id']+'">Single</label>';
                        html2 +=  '</div>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">'
                        html2 +=  '<input type="radio" class="custom-control-input"  onchange="selectinputtype('+proper['pd_field_id']+',2);"';
                        html2 +=  'id="status_input_Mutl'+proper['pd_field_id']+'"  name="status_input['+proper['pd_field_id']+']"';
                        html2 +=  'value="2" '+ ((proper['status_input'] == 2)  ? "checked" : " ") + '>';
                        html2 +=  '<label class="custom-control-label"';
                        html2 +=  'for="status_input_Mutl'+proper['pd_field_id']+'">Multiple</label>';
                        html2 +=  '</div>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">';
                        html2 +=  ' <input type="radio" class="custom-control-input"  onchange="selectinputtype('+proper['pd_field_id']+' ,3);"';                                             
                        html2 +=  ' id="status_input_Rang'+proper['pd_field_id']+'" name="status_input['+proper['pd_field_id']+']" value="3" '+ ((proper['status_input'] == 3)  ? "checked" : " ") + '>';
                        html2 +=  ' <label class="custom-control-label"  for="status_input_Rang'+proper['pd_field_id']+'">Range</label></div>';
                        html2 +=  ' </div>';
                        html2 +=  ' <div class="mulltiple-box'+proper['pd_field_id']+' '+ ((proper['status_input'] == 2)  ? "d-block" : "d-none") + '">';
                        html2 += ' <div class="product-custom-field addfield1">';
                        html2 += ' <div class="form-group input-group">';
                        html2 += ' <span class="input-group-addon p-l">1</span>';
                        html2 += ' <input name="inputNumber['+proper['pd_field_id']+'][m][1]" value="'+proper['data_1']+'" type="number" step="any"   class="form-control">';
                        html2 += ' <span  class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+' , 1);">-</span>';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 += ' <div class="product-custom-field addfield2">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">2</span>';
                        html2 += ' <input name="inputNumber['+proper['pd_field_id']+'][m][2]" value="'+proper['data_2']+'" type="number" step="any"   class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+' , 2);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';

                        html2 += '<div class="product-custom-field addfield3">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">3</span>'
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][m][3]" value="'+proper['data_3']+'" type="number" step="any" ';
                        html2 += ' class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+', 3);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        if(proper['data_4'] != null && proper['data_4'] != ''){
                        html2 += '<div class="product-custom-field addfield4">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">4</span>'
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][m][4]" value="'+proper['data_4']+'" type="number" step="any" ';
                        html2 += ' class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+',4);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        }
                        if(proper['data_5'] != null && proper['data_5'] != ''){
                        html2 += '<div class="product-custom-field addfield5">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">5</span>'
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][m][5]" value="'+proper['data_5']+'" type="number" step="any" ';
                        html2 += ' class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+', 5);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        }

                        if(proper['data_6'] != null && proper['data_6'] != ''){
                        html2 += '<div class="product-custom-field addfield6">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">6</span>'
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][m][6]" value="'+proper['data_6']+'" type="number" step="any" ';
                        html2 += ' class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+', 6);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        }
                        if(proper['data_7'] != null && proper['data_7'] != ''){
                        html2 += '<div class="product-custom-field addfield7">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">7</span>'
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][m][7]" value="'+proper['data_7']+'" type="number" step="any" ';
                        html2 += ' class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+', 7);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        }

                        if(proper['data_8'] != null && proper['data_8'] != ''){
                        html2 += '<div class="product-custom-field addfield8">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">8</span>'
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][m][8]" value="'+proper['data_8']+'" type="number" step="any" ';
                        html2 += ' class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+', 8);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        }

                        if(proper['data_9'] != null && proper['data_9'] != ''){
                        html2 += '<div class="product-custom-field addfield9">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">9</span>'
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][m][9]" value="'+proper['data_9']+'" type="number" step="any" ';
                        html2 += ' class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+', 9);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        }
                        if(proper['data_10'] != null && proper['data_10'] != ''){
                        html2 += '<div class="product-custom-field addfield10">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">10</span>'
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][m][10]" value="'+proper['data_10']+'" type="number" step="any" ';
                        html2 += ' class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+', 10);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        }

                        if(proper['data_11'] != null && proper['data_11'] != ''){
                        html2 += '<div class="product-custom-field addfield11">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">11</span>'
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][m][11]" value="'+proper['data_11']+'" type="number" step="any" ';
                        html2 += ' class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+', 11);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        }

                        if(proper['data_12'] != null && proper['data_12'] != ''){
                        html2 += '<div class="product-custom-field addfield12">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">12</span>'
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][m][12]" value="'+proper['data_12']+'" type="number" step="any" ';
                        html2 += ' class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+', 12);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        }
                   

                        html2 += '<div class="btn-add-input">'
                        html2 += '<div class="form-group input-group">';
                        html2 += '<button type="button" class="btn" onclick="addMutlple('+proper['pd_field_id']+');">';
                        html2 += ' Add </button>';
                        html2 += '</div></div></div>';
                        html2 += '<div class="range-box'+proper['pd_field_id']+' '+ ((proper['status_input'] == 3)  ? "d-block" : "d-none") + '">';
                        html2 += '<div class="product-custom-field-min">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">Min</span>';
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][r][1]" type="number" value="'+proper['data_1']+'" step="any"  ';
                        html2 += 'class="form-control">';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 +='<div class="product-custom-field-min">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">Max</span>';
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][r][2]" type="number" value="'+proper['data_2']+'" step="any"  ';
                        html2 += 'class="form-control">';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 += ' </div>';
                        html2 += ' <div class="single-box'+proper['pd_field_id']+' '+ ((proper['status_input'] == 1)  ? "d-block" : "d-none") + '">';
                        html2 += '<div class="product-custom-field-min">';
                        html2 +=  '<div class="form-group input-group ">';
                        html2 +=  '<input name="inputNumber['+proper['pd_field_id']+'][s][1]" type="number"  value="'+proper['data_1']+'" step="any" ';
                        html2 +=  'class="form-control">';
                        html2 +=   '</div>';
                        html2 += '</div>';
                        html2 += '</div>';
                        html2 +=' </div>';
                         }
                        }
                       }
                     });
                     
                     $.each(feilds, function(index_feild,feild){
                        if(sect['sectid'] == feild['section_id']){
                          if(feild['type'] == "text"){
                                
                         html2 +=  '<input type="hidden" class="form-control" name="productfieldText[]" value="'+feild['pd_field_id']+'">';
                         $.each(allLangs, function(index_allLang,allLang){
                            html2 +=  '<div class="data-text '+((allLang['name'] == lang)  ? "d-block" : "d-none")+ '">';
                            html2 += '<div class="form-group">';
                            html2 += '<label class="d-block">'+feild['field_name']+'</label>';
                            html2 += ' <input type="text" class="form-control" name="inputText['+feild['pd_field_id']+']['+allLang['name']+']" value=""> </div>';
                            html2 += ' </div>';
                           });
                         }else{
                        html2 +=  '<div class="data-number">';
                        html2 +=  ' <input type="hidden" class="form-control"';
                        html2 +=  ' name="productfieldNumbers[]" value="'+feild['pd_field_id']+'">'
                        html2 +=  '<div class="form-group">';
                        html2 +=  '<label class="d-block">'+feild['field_name']+'</label>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">';
                        html2 +=  '<input type="radio" class="custom-control-input" onchange="selectinputtype('+feild['pd_field_id']+',1);"';
                        html2 +=  'id="status_input_sig'+feild['pd_field_id']+'" name="status_input['+feild['pd_field_id']+']"';
                        html2 +=  'value="1"  checked >';
                        html2 +=  '<label class="custom-control-label"for="status_input_sig'+feild['pd_field_id']+'">Single</label>';
                        html2 +=  '</div>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">'
                        html2 +=  '<input type="radio" class="custom-control-input"  onchange="selectinputtype('+feild['pd_field_id']+',2);"';
                        html2 +=  'id="status_input_Mutl'+feild['pd_field_id']+'"  name="status_input['+feild['pd_field_id']+']"';
                        html2 +=  'value="2" >';
                        html2 +=  '<label class="custom-control-label"';
                        html2 +=  'for="status_input_Mutl'+feild['pd_field_id']+'">Multiple</label>';
                        html2 +=  '</div>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">';
                        html2 +=  ' <input type="radio" class="custom-control-input"  onchange="selectinputtype('+feild['pd_field_id']+' ,3);"';                                             
                        html2 +=  ' id="status_input_Rang'+feild['pd_field_id']+'" name="status_input['+feild['pd_field_id']+']" value="3" >';
                        html2 +=  ' <label class="custom-control-label"  for="status_input_Rang'+feild['pd_field_id']+'">Range</label></div>';
                        html2 +=  ' </div>';
                        html2 +=  ' <div class="mulltiple-box'+feild['pd_field_id']+' d-none">';
                        html2 += ' <div class="product-custom-field addfield1">';
                        html2 += ' <div class="form-group input-group">';
                        html2 += ' <span class="input-group-addon p-l">1</span>';
                        html2 += ' <input name="inputNumber['+feild['pd_field_id']+'][m][1]"  type="number" step="any"  class="form-control">';
                        html2 += ' <span  class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+feild['pd_field_id']+' , 1);">-</span>';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 += ' <div class="product-custom-field addfield2">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">2</span>';
                        html2 += ' <input name="inputNumber['+feild['pd_field_id']+'][m][2]" type="number" step="any"   class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+feild['pd_field_id']+' , 2);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        html2 += '<div class="product-custom-field addfield3">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">3</span>'
                        html2 += '<input name="inputNumber['+feild['pd_field_id']+'][m][3]"  type="number" step="any" ';
                        html2 += ' class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+feild['pd_field_id']+', 1);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        html2 += '<div class="btn-add-input">'
                        html2 += '<div class="form-group input-group">';
                        html2 += '<button type="button" class="btn" onclick="addMutlple('+feild['pd_field_id']+');">';
                        html2 += ' Add </button>';
                        html2 += '</div></div></div>';
                        html2 += '<div class="range-box'+feild['pd_field_id']+' d-none">';
                        html2 += '<div class="product-custom-field-min">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">Min</span>';
                        html2 += '<input name="inputNumber['+feild['pd_field_id']+'][r][1]" type="number" step="any"  ';
                        html2 += 'class="form-control">';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 +='<div class="product-custom-field-min">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">Max</span>';
                        html2 += '<input name="inputNumber['+feild['pd_field_id']+'][r][2]" type="number" step="any"  ';
                        html2 += 'class="form-control">';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 += ' </div>';
                        html2 += ' <div class="single-box'+feild['pd_field_id']+' ">';
                        html2 += '<div class="product-custom-field-min">';
                        html2 +=  '<div class="form-group input-group ">';
                        html2 +=  '<input name="inputNumber['+feild['pd_field_id']+'][s][1]" type="number"  step="any" ';
                        html2 +=  'class="form-control">';
                        html2 +=   '</div>';
                        html2 += '</div>';
                        html2 += '</div>';
                        html2 +=' </div>';
                         }
                        }
                       
                    });
                            html2 +=  '</div>';
                            html2 +=    '</div>';
                            html2 +=    ' </div>';
                 });
                      html2 +=  '</div>';
                      $('#contenttdata').html(html2);

         }
        function selectinputtype(id ,type){
        
                // $('.single-box'+id+' input[type="number"]').val('');
                // $('.mulltiple-box'+id+' input[type="number"]').val('');
                // $('.range-box'+id+' input[type="number"]').val('');

                $('.single-box'+id).removeClass('d-block');
                $('.mulltiple-box'+id).removeClass('d-block');
                $('.range-box'+id).removeClass('d-block');
            if(type == 1){
                $('.single-box'+id).addClass('d-block');
                $('.mulltiple-box'+id).addClass('d-none');
                $('.range-box'+id).addClass('d-none');
            }else if(type == 2){
                $('.single-box'+id).addClass('d-none');
                $('.mulltiple-box'+id).addClass('d-block');
                $('.range-box'+id).addClass('d-none');
            }else if(type == 3){
                $('.single-box'+id).addClass('d-none');
                $('.mulltiple-box'+id).addClass('d-none');
                $('.range-box'+id).addClass('d-block');

              
            }

     }
    function addMutlple(id){
        var numItems = $('.mulltiple-box'+id).find('.product-custom-field').length;
        if(numItems < 12){
            var html = '';
            html += '<div class="product-custom-field addfield'+(numItems+1)+'">';
            html += '<div class="form-group input-group">';
            html += ' <span class="input-group-addon p-l">'+(numItems+1)+'</span>';
            html += '<input name="inputNumber['+id+'][m]['+(numItems+1)+']" type="number" step="any"  class="form-control">';
            html += '<span class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+id+','+(numItems+1)+');">-</span></div>';
            html += '</div>';
            $('.mulltiple-box'+id).append(html)
            $('.mulltiple-box'+id +' .btn-add-input').insertAfter('.mulltiple-box'+id+' .product-custom-field:last-child')

        }else{
            alert('Max Multiple is 12');
        }
        
        }

    function deletemutifield(id,numItems){
        $('.mulltiple-box'+id + ' .addfield'+numItems).remove();
        $('.mulltiple-box'+id+ ' .product-custom-field').attr('class', 'product-custom-field');
        $.each($('.mulltiple-box'+id+ ' .product-custom-field'),function(index,val){
            $(val).addClass('addfield'+(index+1))
            $(val).children('.input-group').children('.input-group-addon.p-l').text(index+1);
            $(val).children('.input-group').children('input').attr('name','inputNumber['+id+']['+(index+1)+']')
            $(val).children('.input-group').children('.input-group-addon.number_type_remove.p-r').attr('onclick','deletemutifield('+id+','+(index+1)+');')
        })
    }

    function selectlang(lang){
        getHtmlContent(lang);
    }

        $( document ).ready(function() {
            selectProductcategories();
            getHtmlContent('en');
        });

        var categorie = arrCate;
    function selectProductcategories(id) {

        if(categorie.indexOf(id) == -1){
            categorie.push(id);
        }else{
        var index = categorie.indexOf(id);
            if (index > -1) {
                categorie.splice(index, 1);
            }
        }
        var  serieId = "<?php echo e($products[0]->series_id); ?>";
        console.log(serieId);
        $.ajax({
            url: "<?php echo e((route('searhSeries'))); ?>" ,
            data: {
            'data': categorie,
           },
           type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // console.log(data);
                var options = '';
                options += '<option></option>';
                for (var i = 0; i < data.modalContent.length; i++) {
                    if(serieId == data.modalContent[i].se_id ){
                        options += '<option value="' + data.modalContent[i].se_id + '" selected>' + data.modalContent[i].title + '</option>';
                    }else{
                        options += '<option value="' + data.modalContent[i].se_id + '" >' + data.modalContent[i].title + '</option>';
                    }
                }
                $("select#SeriesId").html(options);
            }

        });

    }

    var previewImage = function (input, block) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        var extension = input.files[0].name.split('.').pop().toLowerCase(); /*se preia extensia*/
        var isSuccess = fileTypes.indexOf(extension) > -1; /*se verifica extensia*/

        if (isSuccess) {
            var reader = new FileReader();
            reader.onload = function (e) {
                block.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
            return false;
        } else {
            alert('File is not expept!');
            return true;
        }

    };


    $(document).on('change', '#thumbnail', function () {
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        } else {
            previewImage(this, $('.imagePreview2'));
        }

    });

      </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/product/edit.blade.php ENDPATH**/ ?>