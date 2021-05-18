$eid = $_SESSION['eid'];
                                                $sql = "SELECT student.Fullname, student.Matric, student.id, trybook.Programme, trybook.FromDate, trybook.ToDate, trybook.Destination, trybook.PostingDate, trybook.Status, 
trybook.AdminRemark,trybook.AdminRemarkDate from trybook join student on trybook.empid=student.id where trybook.id=:lid";\
Fullname,Matric from student where id=:eid";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {
//buat yang ni, dua cara . atas dan bawah. 1 ) where id - eid. 
2- gabunagn trybook
                       
                       
<?php
                            $eid = $_SESSION['eid'];
                            $sql = "SELECT vehicle,ToDate,FromDate,Programme,Destination,AdminRemarkDate,AdminRemark,Status from trybook where empid=:eid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {               ?>
                                    <tr>