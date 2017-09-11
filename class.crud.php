public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <th scope="row"><label class="custom-control custom-checkbox"><input type="checkbox" name="chkOne" class="form-check-input"></label></th>
				<td style="display:none"><?php print($row['id']); ?></td>
				<td><?php print($row['nome']); ?></td>
                <td><?php print($row['contato']); ?></td>
                <td><?php print($row['telefone']); ?></td>
                <td><?php print($row['endereco']); ?></td>
				<td><?php print($row['cidade']); ?></td>

                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Sem unidades cadastradas...</td>
            </tr>
            <?php
		}
		
	}
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		$total_no_of_records = $stmt->rowCount();

		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			
			$current_page=1;
			
			if(isset($_GET["currentPage"]))
			{
				$current_page=$_GET["currentPage"];
			
		
			
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li class='page-item'><a href='currentPage=1' class='page-link' data-href='1'>First</a></li>";
				echo "<li class='page-item'><a href='currentPage=".$previous."' class='page-link' data-href='".$previous."'>Back</a></li>";

			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo $current_page;
					echo "<li class='page-item'><a href='currentPage=".$i."' class='page-link' data-href='".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li class='page-item'><a href='currentPage=".$i."' class='page-link' data-href='".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				
				$next=$current_page+1;
				echo "<li class='page-item'><a href='currentPage=".$next."' class='page-link' data-href='".$next."'>Next</a></li>";
				echo "<li class='page-item'><a href='currentPage=".$total_no_of_pages."' class='page-link' data-href='".$total_no_of_pages."'>Last</a></li>";
			}
			?></ul><?php
		}
	}
