<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'ใบเบิก', 'icon' => 'file-code-o', 'url' => ['order/index']],
                    [
                        'label' => 'รับเข้าสต๊อก', 
                        'icon' => 'file-code-o', 
                        'url' => '#',
                        'items' => [
                            ['label' => 'ใบรับสินค้าทั้งหมด', 'icon' => 'file-code-o', 'url' => ['receipt/index'],],
                            ['label' => 'เพิ่มสินค้าเข้าสต๊อก', 'icon' => 'file-code-o', 'url' => ['receipt/add'],],
                            ['label' => 'ข้อมูลบริษัท', 'icon' => 'file-code-o', 'url' => ['seller/index'],],
                        ]
                    ],
                    [
                        'label' => 'Product', 
                        'icon' => 'file-code-o', 
                        'url' => '#',
                        'items' => [
                            ['label' => 'Product-All', 'icon' => 'file-code-o', 'url' => ['product/index'],],
                            ['label' => 'Product-Stock-Down', 'icon' => 'file-code-o', 'url' => ['product/stock_down'],],
                            ['label' => 'Product-Catalog', 'icon' => 'file-code-o', 'url' => ['product_catalog/index'],],
                            ['label' => 'Product-Unit', 'icon' => 'file-code-o', 'url' => ['product_unit/index'],],
                        ]
                    ],                    
                    [
                        'label' => 'รายงาน', 
                        'icon' => 'file-code-o', 
                        'url' => '#',
                        'items' => [
                            ['label' => 'Report', 'icon' => 'file-code-o', 'url' => ['report/index'],],
                            ['label' => 'Report/view', 'icon' => 'file-code-o', 'url' => ['report/view2'],],
                            ['label' => 'ประจำปี 2562', 'icon' => 'file-code-o', 'url' => ['report/v','y'=>'2562'],],
                        ]
                    ],
                    [
                        'label' => 'Log-In-Out',
                        'icon' => 'envelope-o',
                        'url' => ['log_st/index'],
                        'template'=>'<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-yellow">123</small></span></a>'
                    ],
                    // [
                    //     'label' => 'Setting', 
                    //     'icon' => 'file-code-o', 
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'index', 'icon' => 'file-code-o', 'url' => ['/setting/index'],],
                    //         ['label' => 'ปรับ Logst->receipt_list_id', 'icon' => 'file-code-o', 'url' => ['/log_st/up_receipt_list_id'],],
                    //         ['label' => 'ปรับ instoke', 'icon' => 'file-code-o', 'url' => ['/product/upstoke'],],
                    //         ['label' => 'ปรับ ReceiptList->LogSt', 'icon' => 'file-code-o', 'url' => ['/setting/up_receipt_to_logst'],],
                            
                    //     ]
                    // ],
                    
                ],
            ]
        ) ?>

    </section>

</aside>
