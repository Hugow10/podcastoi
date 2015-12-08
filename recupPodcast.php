
<?php

        class RecupUserPodcast {
                
                
                 private $db;
                
  
                        public function __construct(MySQLi $db){
                                
                                $this->db = $db;
                
                                
                                        }
  
                
                          public  function  RecupUtilisateur($object) {
                                //session_start();
                        $pseudo='pseudo';
                        $object=strtolower($object);
                $sess= new Session();
                
                        $user_session=$sess->__get($pseudo);
                        echo 'type :'.gettype($user_session).'<br/>';
                        $yy=var_dump($user_session);
                
                        if(strtolower( $object) == "nom") {
                                
                                 try{
                                        $req=$this->db->query("SELECT u_nom as lenom FROM utilisateur WHERE pseudo='$user_session' ");
                                                                                $req=$req->fetch_object()->lenom;
                                        } catch(Exception $e){
                                                echo "Une erreur est survenue !".$e->getMessage();
                  
          }
                                
                        }else if (strtolower($object) == "prenom" || strtolower($object) == "prénom"  ) {
                                
                                 try{
                                        $req=$this->db->query("SELECT u_prenom as leprenom FROM utilisateur WHERE pseudo='$user_session' ");
                                        $req=$req->fetch_object()->leprenom;
                                        } catch(Exception $e){
                                                echo "Une erreur est survenue !".$e->getMessage();
                  
          }
                  
                  
                        else if (strtolower($object) == "id") {
                                
                                 try{
                                        $req=$this->db->query("SELECT id_util as lid FROM utilisateur WHERE pseudo='$user_session' ");
                                        $req=$req->fetch_object()->lid;
                                        } catch(Exception $e){
                                                echo "Une erreur est survenue !".$e->getMessage();
                  
          }
                                
                        } 
                                                
                        else if (strtolower($object) == "mail"  ) {
                                
                                 try{
                                        $req=$this->db->query("SELECT mail as lemail FROM utilisateur WHERE pseudo='$user_session' ");
                                        $req=$req->fetch_object()->lemail;
                                        } catch(Exception $e){
                                                echo "Une erreur est survenue !".$e->getMessage();
                  
          }
                                
                        } 
                        else if (strtolower($object) == "nb_page" || strtolower($object) == "nb page" ||strtolower($object) == "nb-page"  ) {
                                
                                 try{
                                        $req=$this->db->query("SELECT Nb_page as page FROM utilisateur WHERE pseudo='$user_session' ");
                                        $req=$req->fetch_object()->page;
                                        } catch(Exception $e){
                                                echo "Une erreur est survenue !".$e->getMessage();
                  
          }
                                
                        } 
                        return $req;
                        
                        
                }
                
      
      
      
                
                
                
                public  function  RecupPodcast($object) {
                                //session_start();
                        $pseudo='pseudo';
                        $object=strtolower($object);
                $sess= new Session();
                
                        $user_session=$sess->__get($pseudo);
                        echo 'type :'.gettype($user_session).'<br/>';
                        $yy=var_dump($user_session);
                
                        if( $object == "url") {
                                
                                 try{
                                        $req=$this->db->query("SELECT url as lurl FROM podcast p, preference p, utilisateur u WHERE pseudo='$user_session' AND u.id_util=pref.id_util AND pref.id_genre=p.id_genre ");
                                $req=$req->fetch_object()->lurl;
                                
                                
                                
                                echo $req;
                                
                                        } catch(Exception $e){
                                                echo "Une erreur est survenue !".$e->getMessage();
                  
          }
                                
                        }else if (strtolower($object) == "prenom" || strtolower($object) == "prénom"  ) {
                                
                                
                                
                                 try{
                                        $req=$this->db->query("SELECT u_prenom as leprenom FROM utilisateur WHERE pseudo='$user_session' ");
                                        $req=$req->fetch_object()->leprenom;
                                        } catch(Exception $e){
                                                echo "Une erreur est survenue !".$e->getMessage();
                  
          }
                                
                                
                        } 
                        return $req;
                        
                        
                }
                
                
                
                
        }
        
        
        ?>