<div class="cl_dialog add_element_dialog" id="cl_dialog_add_element">
    <a href="#" class="go_back"><i class="cl-builder-icon-arrow-left"></i></a>
    <a href="#" class="close_dialog"><i class="cl-builder-icon-cross"></i></a>
    <div class="wrapper">
        <div class="tabs">
            <a href="#" class="actived" data-tab="elements">Elements</a>
            <a href="#" data-tab="content_blocks">Content Blocks</a>
        </div>

        <div id="tab-elements" class="tab-content actived">

            <div class="search-wrapper"><input type="search" id="search" value="" placeholder="Search" /></div>

            <div class="content-wrapper">
                <div class="elements_ content-page actived" style="display:block;">
                    <?php $predefinedList = array(); ?> 
                    <?php foreach(Cl_Builder_Mapper::getShortcodes() as $shortcode => $attrs): ?>

                        <?php if( $shortcode != 'cl_page_header' && codeless_is_blog_query() ) continue; ?>
                        <?php if( isset( $attrs['show_only_on'] ) && $attrs['show_only_on'] != get_post_type() ) continue; ?>
                        <?php if( isset( $attrs['hide_from_list'] ) && $attrs['hide_from_list'] ) continue; ?>
                        
                        <?php if( isset($attrs['icon']) && !empty($attrs['icon']) ): ?>

                        <div class="element <?php echo (isset($attrs['predefined'])) ? 'with_predefined' : ''; ?>" data-tag="<?php echo $shortcode ?>">
                            <div class="title-part">
                                <i class="<?php echo $attrs['icon'] ?>"></i>
                                <span class="title"><?php echo $attrs['label'] ?></span>
                            </div>
                            
                            <div class="how_to">
                                <a href="#" class="from_scratch" title="Add, create from scratch">Add</a>
                                <?php if( isset($attrs['predefined']) ): $predefinedList[$shortcode] = $attrs['predefined']; ?>

                                    <a href="#" class="predefined_list" title="Open Predefined List of this element" data-linked-tag="<?php echo $shortcode ?>">List</a>
                                <?php endif; ?>
                            </div>
                            

                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?> 

                </div>

                <div class="predefined content-page">
                <?php foreach( $predefinedList as $element => $attr): ?>
                    <div class="predefined_container" data-tag="<?php echo $element ?>">
                        <?php foreach( $attr as $id => $pre ): ?>
                            <a class="pre_element" href="#" id="<?php echo $id ?>">
                                <img class="lazy" data-original="<?php echo $pre['photo'] ?>">
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
                </div>

            </div>

        </div>

        <div id="tab-content_blocks" class="tab-content">

            <div class="content-wrapper">
                <?php foreach( $cl_page_builder->content_blocks as $block_id => $block): ?>
                    <?php $style = ''; 
                       $url = get_the_post_thumbnail_url( $block_id );
                       if( $url !== false ):
                        $img = '<img src="'.$url.'" alt="" />';
                       endif; ?>
                    <div class="content_block type_<?php echo $block['type']; ?>" style="<?php echo $style ?>">
                        <a href="#" class="content-block" data-id="<?php echo $block_id ?>"></a>
                        <?php echo $img; ?>
                        <span><?php echo $block['name'] ?></span>
                        <label>
                            <input type="checkbox" name="replace_column" id="replace_column" value="replace_column" checked>
                            Replace Column
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>


    </div>
    
</div>



<div class="cl_dialog add_element_dialog" id="cl_dialog_add_header_element">
   
    <a href="#" class="close_dialog"><i class="cl-builder-icon-cross"></i></a>
    <div class="wrapper">

        <div id="tab-elements" class="tab-content actived">

            

            <div class="content-wrapper">
                <div class="elements_ content-page actived" style="display:block;">
                    <?php foreach(Cl_Builder_Mapper::getHeaderElements() as $element => $attrs): ?>
                    <?php if( isset($attrs['icon']) && !empty($attrs['icon']) ): ?>

                        
                        <div class="element " data-type="<?php echo $element ?>">
                            
                                <div class="title-part">
                                    <i class="<?php echo $attrs['icon'] ?>"></i>
                                    <span class="title"><?php echo $attrs['label'] ?></span>
                                </div>

                                <div class="how_to">
                                    <a href="#" class="from_scratch" title="Add, create from scratch">Add</a>
                                </div>
                          
                        </div>
                        
                    <?php endif; ?>
                    <?php endforeach; ?>

                </div>

            </div>

        </div>

    </div>
    
</div>




<div class="cl_dialog change_icon" id="cl_dialog_change_icon">
    <a href="#" class="close_dialog"><i class="cl-builder-icon-cross"></i></a>
    <div class="search-wrapper"><input type="search" id="search" value="" placeholder="Search" /></div>
    
    <div class="icons-wrapper">
        <?php foreach( Codeless_Icons::get_icons() as $icon ): ?>
            <div class="icon" data-value="<?php echo $icon ?>">
                
                <i class="<?php echo $icon ?>"></i>
              
                
            </div>
        <?php endforeach; ?>
    </div>
    
</div>

<div class="cl_dialog change_layout" id="cl_dialog_custom_layout">
    <div class="wrapper">
        <input type="text" id="custom_layout" value="" placeholder="1/2 + 1/2" />
        <input type="button" id="submit" value="Change" />
    </div>
    
</div>


<div class="cl_dialog" id="cl_save_element_template">
    <a href="#" class="close_dialog"><i class="cl-builder-icon-cross"></i></a>
    <div class="wrapper">
        <h5>Save Template</h5>
        <p><strong>Attention:<strong> Be sure to Publish Page before saving the template! After the Save a refresh will take effect and your changes can loose.</p>
        <p>
            <label>Template Name</label>
            <input type="text" id="template_name" value="" placeholder="Ex: Row with 3 Services" />
        </p>
        <p>
            <label>Template Key (Used for the image too.) </label>
            <input type="text" id="template_key" value="" placeholder="Ex: row_3_services" />
        </p>
        <input type="button" id="submit" value="Save" />
    </div>
    
</div>