<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Company;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CompaniesController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        phpinfo();
        return Grid::make(new Company(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('code');
            $grid->column('name');
            //$grid->column('short_name');
            $grid->short_name('头像')->image('', 50, 50);
            $grid->column('sap_code');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Company(), function (Show $show) {
            $show->field('id');
            $show->field('code');
            $show->field('name');
            $show->field('short_name');
            $show->field('sap_code');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Company(), function (Form $form) {
            $form->display('id');
            $form->text('code');
            $form->text('name');
            //$form->text('short_name');
            $form->text('sap_code');
            $folder_name = "images/" . date("Ym", time()) . '/' . date("d", time());
            $form->image('short_name', '头像')->removable()->move($folder_name)->uniqueName();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
