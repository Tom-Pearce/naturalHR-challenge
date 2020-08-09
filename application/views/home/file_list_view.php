<table class="table table-striped">
  <thead>
    <tr>
      <th>File</th>
      <th>User</th>
      <th>Date</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($files as $key => $file){?>
      <tr>
        <td><?php echo $file['file_name'];?></td>
        <td><?php echo $file['first_name'] . ' ' . $file['last_name'];?></td>
        <td><?php echo date('d/m/Y H:i:s', strtotime($file['upload_date']));?></td>
      </tr>
    <?php }?>
  </tbody>
</table>
