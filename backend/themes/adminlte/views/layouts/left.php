<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
       <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?/*= $directoryAsset */?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->

        <!-- search form -->
       <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Menu for Admin', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Content Management',
                        'icon' => 'edit',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Courses',
                                'icon' => 'pencil',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Manage course', 'icon' => 'reorder', 'url' => Yii::$app->getHomeUrl().'content/course/index',],
                                ],
                            ],
                            [
                                'label' => 'Showcases',
                                'icon' => 'file-photo-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Categories', 'icon' => 'plus', 'url' => Yii::$app->getHomeUrl().'content/showcasetype/index',],
                                    ['label' => 'Techniques', 'icon' => 'plus', 'url' => Yii::$app->getHomeUrl().'content/technique/index',],
                                    ['label' => 'Manage showcases', 'icon' => 'th-large', 'url' => Yii::$app->getHomeUrl().'content/showcase/index',],
                                    //  ['label' => 'Manage showcase profiles', 'icon' => 'circle-o', 'url' => '#',],
                                ],
                            ],
                            [
                                'label' => 'Study Trips',
                                'icon' => 'bullhorn',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Categories', 'icon' => 'plus', 'url' => Yii::$app->getHomeUrl().'content/activitytype/index',],
                                    ['label' => 'Manage study trips', 'icon' => 'th-large', 'url' => Yii::$app->getHomeUrl().'content/activity/index',],
                                    // ['label' => 'Manage activites photos', 'icon' => 'circle-o', 'url' => '#',],
                                ],
                            ],
                        ],
                    ],
                    ['label' => 'User Management', 'icon' => 'user', 'url' => ['/personal/profile/index']],
                ],
            ]
        ) ?>

    </section>

</aside>
