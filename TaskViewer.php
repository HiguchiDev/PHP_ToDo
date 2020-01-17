<?php
    class TaskViewer{

        public function view($contants){
            if(is_array($contants)){
                foreach ($contants as $value) {    
                    print '<dt>';
                    print $value["name"];
                    print '</dt>';

                    print '<dd>';
                    print $value["memo"];
                    print '</dd>';
                }
            }
        }
    }