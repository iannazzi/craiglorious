<?php namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Models\Craiglorious\System;

class Role extends BaseModel
{
    protected $guarded = ['id'];
    //there are two views
    //one is the allowed view for the user
    //one is the list of permissions for a view
    public function isAdmin()
    {
        if (strtolower($this->name) == 'administrator')
        {
            return true;
        }

        return false;
    }

    //waht views can the user access
    public function userViews()
    {
        //$system = \Auth::user()->system;
        //all of the possible views
        $system_id = session('system');
        $system = System::find($system_id);
        $views = $system->views();

        //Views for the role - limited results
        $query = \DB::table('role_view');
        $query->where('role_id', '=', $this->id);
        $results = $query->get();

        //we need to manually add the name back in for the view
        foreach ($results as $result)
        {
            foreach ($views as $view)
            {
                if ($result->view_id == $view->id)
                {
                    $result->name = $view->name;
                    $result->icon = $view->icon;
                    $result->route = $view->route;
                    $result->place = $view->place;

                }
            }
        }
        foreach ($results as $result)
        {
            if ($result->access != 'none')
            {
                $return[] = $result;
            }
        }

        return $return;


    }

    //what views can the system access
    public function systemViews()
    {

        //$system = \Auth::user()->system;
        $system_id = session('system');
        $system = System::find($system_id);
        //all of the possible views
        $views = $system->views();

        $query = \DB::table('role_view');
        $query->where('role_id', '=', $this->id);
        $results = $query->get();

        //we need to return view id, access = none, write, or read
        //we need to manually add the name back in for the view
        foreach ($results as $result)
        {
            foreach ($views as $view)
            {
                if ($result->view_id == $view->id)
                {
                    $result->name = $view->name;
                }
            }
        }


        return $results;


    }

    public function users()
    {
        return $this->hasMany('App\Models\Tenant\User');
    }

    //each category might have one parent
    public function parent()
    {
        return $this->belongsToOne(static::class, 'parent_id');
    }

    //each category might have multiple children
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }


    function getRoleChildrenIds()
    {
        if ($this->isAdmin())
        {
            return $this->all()->pluck('id')->toArray();
        }
        $roles = $this->all();
        $ids = $this->findChildrenIds($roles, $this->id, 1);

        return $ids;
    }

    function findChildrenIds($roles, $parent_id, $level)
    {
        $cat_array = [];
        for ($c = 0; $c < sizeof($roles); $c ++)
        {
            if ($roles[ $c ]['parent_id'] == $parent_id)
            {
                $child_id = $roles[ $c ]->id;
                $cat_array[] = $child_id;
                $children_array = $this->findChildrenIds($roles, $child_id, $level + 1);
                $cat_array = array_merge($cat_array, $children_array);
            }
        }

        return $cat_array;
    }


    function getRoleSelectTree()
    {
        //with exception of the admin
        //find all roles below users current role
        $roles = $this->all();
        if (\Auth::user()->isAdmin())
        {
            return [[
                'name' => $this->name,
                'value' => $this->id,
                'children' => $this->findChildren($roles, $this->id, 1)
            ]];

        }

        return $this->findChildren($roles, $this->id, 1);


    }

    function findChildren($roles, $parent_id, $level)
    {
        $cat_array = array();
        for ($c = 0; $c < sizeof($roles); $c ++)
        {
            if ($roles[ $c ]['parent_id'] == $parent_id)
            {
                $ret_array = [];
                $ret_array['value'] = $roles[ $c ]->id;
                $ret_array['name'] = $roles[ $c ]->name;
                $children = $this->findChildren($roles, $roles[ $c ]->id, $level + 1);
                if (sizeof($children) > 0)
                {
                    $ret_array['children'] = $children;
                }
                $cat_array[] = $ret_array;
            }
        }

        return $cat_array;
    }

    function getSelectableParents()
    {
        //take the tree array and delete the node where the id is....
        $roles = $this->all();
        $tree = $this->findChildren($roles, 0, 1);

        //recursively go trough the array and delete....

        $trimmed_tree = $this->removeTreeNode($tree, $this->id);
        return $trimmed_tree;




    }

    function removeTreeNode($tree, $id)
    {
        $cat_array = array();
        for ($c = 0; $c < sizeof($tree); $c ++)
        {
            if ($tree[ $c ]["value"] == $id)
            {
                //kill this node
                //return false;
            }
            else{
//                dd($tree[$c]);
                $ret_array = [];
                $ret_array['value'] = $tree[ $c ]['value'];
                $ret_array['name'] = $tree[ $c ]['name'];


                if (isset($tree[$c]['children']))
                {
                   $tmp = $this->removeTreeNode($tree[$c]['children'], $id);
                   if($tmp){
                       $ret_array['children'] = $tmp;
                   }
                }
                //dd($ret_array);
                $cat_array[] = $ret_array;

            }

        }
        return $cat_array;




    }


}