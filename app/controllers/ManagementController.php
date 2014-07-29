<?php


class ManagementController extends BaseController
{
    public function getIndex()
    {
        return "Login page";
    }

    public function postManage()
    {
    //    Attempt to find user in DB
    //    If user found, log the user in and redirect to view IWO
    //    If no user found, redirect back with errors
    }

    public function getView()
    {
        return "Congratulations - you are logged in.";
    }

    public function getEdit()
    {
        return "Edit form";
    }

    public function getError()
    {
        return "ERROR: no entry. Your session may have timed out or you may not have sufficient rights to access this section.";
    }
} 