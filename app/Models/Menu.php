<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menus";

    protected $guarded = [];

    /**
     * Static function to set menus
     */
    public static function setMenus() {
        Menu::truncate();
        MenuActivity::truncate();
        $menus = array(
            [
                'name' => "Profile",
                'activities' => [
                    array('activity_name' => 'Profile View','route_name' => 'admin.profile','is_dependant' => 'No','auto_select' => 'Yes')
                ]
            ],
            [
                'name' => "Dashboard",
                'activities' => [
                    array('activity_name' => 'Dashboard View','route_name' => 'admin.dashboard','is_dependant' => 'No','auto_select' => 'No')
                ]
            ],
            [
                'name' => "To-Do",
                'activities' => [
                    array('activity_name' => 'View To-Do List', 'route_name' => 'admin.to-do-list.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create To-Do', 'route_name' => 'admin.to-do-list.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store To-Do', 'route_name' => 'admin.to-do-list.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'To-Do Details', 'route_name' => 'admin.to-do-list.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit To-Do', 'route_name' => 'admin.to-do-list.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update To-Do', 'route_name' => 'admin.to-do-list.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete To-Do', 'route_name' => 'admin.to-do-list.destroy','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'User Wise To-Do','route_name' => 'admin.user-wise-to-do','is_dependant' => 'Yes','auto_select' => 'Yes'),
                    array('activity_name' => 'Update To-Do Status','route_name' => 'admin.update-to-do','is_dependant' => 'Yes','auto_select' => 'Yes'),
                ]
            ],
            [
                'name' => "Assets",
                'activities' => [
                    array('activity_name' => 'Assets View','route_name' => 'admin.asset-list','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Asset','route_name' => 'admin.edit-asset','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Asset','route_name' => 'admin.update-asset','is_dependant' => 'Yes','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Work Orders",
                'activities' => [
                    array('activity_name' => 'View Work Orders List', 'route_name' => 'admin.work-orders.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Work Orders', 'route_name' => 'admin.work-orders.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Work Orders', 'route_name' => 'admin.work-orders.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Work Orders Details', 'route_name' => 'admin.work-orders.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Work Orders', 'route_name' => 'admin.work-orders.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Work Orders', 'route_name' => 'admin.work-orders.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Work Orders', 'route_name' => 'admin.work-orders.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Products",
                'activities' => [
                    array('activity_name' => 'View Product List', 'route_name' => 'admin.products.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Product', 'route_name' => 'admin.products.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Product', 'route_name' => 'admin.products.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Work Order Details', 'route_name' => 'admin.products.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Product', 'route_name' => 'admin.products.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Product', 'route_name' => 'admin.products.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Product', 'route_name' => 'admin.products.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Invoice",
                'activities' => [
                    array('activity_name' => 'View Product List', 'route_name' => 'admin.invoices.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Product', 'route_name' => 'admin.invoices.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Product', 'route_name' => 'admin.invoices.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Work Order Details', 'route_name' => 'admin.invoices.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Product', 'route_name' => 'admin.invoices.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Product', 'route_name' => 'admin.invoices.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Product', 'route_name' => 'admin.invoices.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Reports",
                'activities' => [
                    array('activity_name' => 'Expense Reports','route_name' => 'admin.expense-reports','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Income Reports','route_name' => 'admin.income-reports','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Profit Reports','route_name' => 'admin.profit-reports','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Task and Calendar",
                'activities' => [
                    array('activity_name' => 'View Task List', 'route_name' => 'admin.task-list.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Task', 'route_name' => 'admin.task-list.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Task', 'route_name' => 'admin.task-list.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Task Details', 'route_name' => 'admin.task-list.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Task', 'route_name' => 'admin.task-list.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Task', 'route_name' => 'admin.task-list.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Task', 'route_name' => 'admin.task-list.destroy','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'View Task Calander', 'route_name' => 'admin.task-calendar','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Task Status', 'route_name' => 'admin.update-task-status','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Employees",
                'activities' => [
                    array('activity_name' => 'View Employee Designation List', 'route_name' => 'admin.employee-designations.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Employee Designation', 'route_name' => 'admin.employee-designations.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Employee Designation', 'route_name' => 'admin.employee-designations.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Employee Designation Details', 'route_name' => 'admin.employee-designations.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Employee Designation', 'route_name' => 'admin.employee-designations.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Employee Designation', 'route_name' => 'admin.employee-designations.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Employee Designation', 'route_name' => 'admin.employee-designations.destroy','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'View Employee List', 'route_name' => 'admin.employees.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Employee', 'route_name' => 'admin.employees.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Employee', 'route_name' => 'admin.employees.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Employee Details', 'route_name' => 'admin.employees.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Employee', 'route_name' => 'admin.employees.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Employee', 'route_name' => 'admin.employees.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Employee', 'route_name' => 'admin.employees.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Clients",
                'activities' => [
                    array('activity_name' => 'View Client List', 'route_name' => 'admin.clients.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Client', 'route_name' => 'admin.clients.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Client', 'route_name' => 'admin.clients.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Client Details', 'route_name' => 'admin.clients.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Client', 'route_name' => 'admin.clients.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Client', 'route_name' => 'admin.clients.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Client', 'route_name' => 'admin.clients.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => " Client Feedback",
                'activities' => [
                    array('activity_name' => 'View Client List', 'route_name' => 'admin.clients.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Client', 'route_name' => 'admin.clients.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Client', 'route_name' => 'admin.clients.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Client Details', 'route_name' => 'admin.clients.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Client', 'route_name' => 'admin.clients.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Client', 'route_name' => 'admin.clients.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Client', 'route_name' => 'admin.clients.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Sister Concerns",
                'activities' => [
                    array('activity_name' => 'View Sister Concern List', 'route_name' => 'admin.sister-concerns.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Sister Concern', 'route_name' => 'admin.sister-concerns.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Sister Concern', 'route_name' => 'admin.sister-concerns.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Sister Concern Details', 'route_name' => 'admin.sister-concerns.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Sister Concern', 'route_name' => 'admin.sister-concerns.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Sister Concern', 'route_name' => 'admin.sister-concerns.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Sister Concern', 'route_name' => 'admin.sister-concerns.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Our Services",
                'activities' => [
                    array('activity_name' => 'View Our Service List', 'route_name' => 'admin.our-services.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Our Service', 'route_name' => 'admin.our-services.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Our Service', 'route_name' => 'admin.our-services.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Our Service Details', 'route_name' => 'admin.our-services.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Our Service', 'route_name' => 'admin.our-services.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Our Service', 'route_name' => 'admin.our-services.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Our Service', 'route_name' => 'admin.our-services.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Expense",
                'activities' => [
                    array('activity_name' => 'View Expense Category List', 'route_name' => 'admin.expense-categories.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Expense Category', 'route_name' => 'admin.expense-categories.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Expense Category', 'route_name' => 'admin.expense-categories.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Expense Category Details', 'route_name' => 'admin.expense-categories.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Expense Category', 'route_name' => 'admin.expense-categories.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Expense Category', 'route_name' => 'admin.expense-categories.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Expense Category', 'route_name' => 'admin.expense-categories.destroy','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'View Expense List', 'route_name' => 'admin.expense-list.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Expense', 'route_name' => 'admin.expense-list.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Expense', 'route_name' => 'admin.expense-list.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Expense Details', 'route_name' => 'admin.expense-list.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Expense', 'route_name' => 'admin.expense-list.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Expense', 'route_name' => 'admin.expense-list.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Expense', 'route_name' => 'admin.expense-list.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Income",
                'activities' => [
                    array('activity_name' => 'View Income Sector List', 'route_name' => 'admin.income-sectors.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Income Sector', 'route_name' => 'admin.income-sectors.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Income Sector', 'route_name' => 'admin.income-sectors.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Income Sector Details', 'route_name' => 'admin.income-sectors.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Income Sector', 'route_name' => 'admin.income-sectors.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Income Sector', 'route_name' => 'admin.income-sectors.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Income Sector', 'route_name' => 'admin.income-sectors.destroy','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'View Income List', 'route_name' => 'admin.incomes.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Income', 'route_name' => 'admin.incomes.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Income', 'route_name' => 'admin.incomes.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Income Details', 'route_name' => 'admin.incomes.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Income', 'route_name' => 'admin.incomes.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Income', 'route_name' => 'admin.incomes.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Income', 'route_name' => 'admin.incomes.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Events",
                'activities' => [
                    array('activity_name' => 'View Event Category List', 'route_name' => 'admin.event-categories.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Event Category', 'route_name' => 'admin.event-categories.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Event Category', 'route_name' => 'admin.event-categories.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Event Category Details', 'route_name' => 'admin.event-categories.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Event Category', 'route_name' => 'admin.event-categories.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Event Category', 'route_name' => 'admin.event-categories.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Event Category', 'route_name' => 'admin.event-categories.destroy','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'View Event List', 'route_name' => 'admin.events.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Event', 'route_name' => 'admin.events.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Event', 'route_name' => 'admin.events.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Event Details', 'route_name' => 'admin.events.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Event', 'route_name' => 'admin.events.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Event', 'route_name' => 'admin.events.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Event', 'route_name' => 'admin.events.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ],
            [
                'name' => "Settings",
                'activities' => [
                    array('activity_name' => 'Website Settings', 'route_name' => 'admin.website-settings','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Website Settings', 'route_name' => 'admin.update-website-settings','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'View Faq List', 'route_name' => 'admin.faqs.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Faq', 'route_name' => 'admin.faqs.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Faq', 'route_name' => 'admin.faqs.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Faq Details', 'route_name' => 'admin.faqs.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Faq', 'route_name' => 'admin.faqs.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Faq', 'route_name' => 'admin.faqs.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Faq', 'route_name' => 'admin.faqs.destroy','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'View Payment Method List', 'route_name' => 'admin.payment-methods.index','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Create Payment Method', 'route_name' => 'admin.payment-methods.create','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Store Payment Method', 'route_name' => 'admin.payment-methods.store','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Payment Method Details', 'route_name' => 'admin.payment-methods.Show','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Edit Payment Method', 'route_name' => 'admin.payment-methods.edit','is_dependant' => 'No','auto_select' => 'No'),
                    array('activity_name' => 'Update Payment Method', 'route_name' => 'admin.payment-methods.update','is_dependant' => 'Yes','auto_select' => 'No'),
                    array('activity_name' => 'Delete Payment Method', 'route_name' => 'admin.payment-methods.destroy','is_dependant' => 'No','auto_select' => 'No'),
                ]
            ]

        );

        foreach ($menus as $menu) {
            $menu_data = [
                'name' => $menu['name'],
                'created_at' => now(),
                'updated_at' => now()
            ];
            Menu::updateOrInsert($menu_data,$menu_data);
            if(count($menu['activities'])) {
                foreach ($menu['activities'] as $activity) {
                    $menu_id = Menu::where('name',$menu)->first()->id;
                    $identify = [
                        'menu_id'=>$menu_id,
                        'route_name' => $activity['route_name']
                    ];
                    $activity_data = [
                        'menu_id'=>$menu_id,
                        'activity_name' => $activity['activity_name'],
                        'route_name' => $activity['route_name'],
                        'is_dependant' => $activity['is_dependant'],
                        'auto_select' => $activity['auto_select'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    MenuActivity::updateOrInsert($identify,$activity_data);
                }
            }
        }
        //return "Done";
    }
    /**
     * Define relation with MenuActivity table
     */
    public function activities()
    {
        return $this->hasMany(MenuActivity::class,'menu_id','id');
    }
}
