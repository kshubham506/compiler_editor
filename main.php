<?php
    session_start();
if(!isset($_SESSION['tok']))
    $_SESSION['tok']="null";

               ini_set('max_execution_time', 300);
                $inp=null;
                $meth=($_REQUEST["meth"]);     //source code
                $inp=($_REQUEST["inp"]);    //std input
                $lang=$_REQUEST["lang"];
                if($meth!="token"){
                    session_destroy();
                    session_start();
                        $code=$meth;
                        $post = [
                           "source_code"=> $code,
                            "language_id"=> $lang,
                            "number_of_runs"=> "1",
                            "stdin"=> $inp,
                          //  "expected_output"=> NULL,
                            "cpu_time_limit"=> "2",
                            "cpu_extra_time"=> "0.5",
                            "wall_time_limit"=> "5",
                            "memory_limit"=> "128000",
                            "stack_limit"=> "64000",
                            "max_processes_and_or_threads"=> "30",
                            "enable_per_process_and_thread_time_limit"=> false,
                            "enable_per_process_and_thread_memory_limit"=> true,
                            "max_file_size"=> "1024"
                        ];
                      

                        $ch = curl_init('https://api.judge0.com/submissions');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                        $response = curl_exec($ch);
                        curl_close($ch);
                        //echo $response."<br>";
                        
                        $res=json_decode($response,true);
                        $_SESSION['tok']=$res['token'];
                        echo $_SESSION['tok'];
                       
                }
        else
        {
                        //echo "Token genertaed - ".$_SESSION['tok']."<br>";
                        $su="https://api.judge0.com/submissions/".$_SESSION['tok'];
                        $sub=@file_get_contents($su);
                        echo $sub;
                      /*  $res1=json_decode($sub,true);    
                        $sta=$res1['status']['id'];*/
             
        }
 ?>

           
    