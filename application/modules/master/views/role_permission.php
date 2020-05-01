<?php if(!empty($menus)){
    echo $this->form_builder->open_form($form_header);
}    
?>
<div class="table-responsive">
    <table class="table table-bordered">
    <thead>
        <tr>
            <th><input onclick="App.checkAll(this)" type="checkbox"></th>
            <th>Nama</th>
            <th>Route</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        if(!empty($menus)){            
            foreach($menus as $m){
                $checked_menu = isset($rolemenus[$m['id']]) ? 'checked' : '';
                echo '<tr>
                    <td><input '.$checked_menu.' value="'.$m['id'].'" name="menu_'.$m['id'].'" type="checkbox" class="menu" data-menu_id="'.$m['id'].'"></td>
                    <td>'.$m['name'].'</td>
                    <td>'.$m['route'].'</td>
                    <td>'.$m['descriptions'].'</td>
                </tr>';
                
                if(!empty($m['menu_permission'])){
                    $rolePermissionsGroup = convertArr($rolePermissions,'menu_permission_id');
                    log_message('error', json_encode($rolePermissionsGroup));
                    foreach($m['menu_permission'] as $mp){                                                
                        $mp = (array) $mp;
                        $checked_permission = isset($rolePermissionsGroup[$mp['id']]) ? 'checked' : '';
                        $route_menu = explode('/',$m['route']);
                        $route_menu[count($route_menu) - 1] = $mp['route'];
                        echo '<tr>
                            <td style="padding-left:30px"><input '.$checked_permission.' onclick="App.setDependency(this)" value="'.$mp['id'].'" name="menu-permission_'.$m['id'].'_'.$mp['id'].'" type="checkbox" class="permissions" data-dependency=\''.json_encode(['menu_id' => $m['id']]).'\'></td>
                            <td style="padding-left:30px">'.$mp['name'].'</td>
                            <td style="padding-left:30px">'.implode('/',$route_menu).'</td>
                            <td></td>
                        </tr>';
                    }    
                }
            }
        }
    ?>
    </tbody>
    </table>
</div>
<?php 
    if(!empty($menus)){
        echo form_submit('simpan', 'simpan',['class' => 'btn btn-success']);
        echo form_hidden('role_id', $referenceId);
        
        echo $this->form_builder->close_form();
    }
?>