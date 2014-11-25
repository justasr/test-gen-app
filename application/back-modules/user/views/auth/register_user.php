<h1><?php echo lang('register_user_heading');?></h1>
<p><?php echo lang('register_user_subheading');?></p>

<div id="infoMessage"><?php echo $output['message'];?></div>

<?php echo form_open("user/auth/register");?>

     <p>
         <?php echo lang('register_user_username_label', 'username');?> <br />
         <?php echo form_input($output['username']);?>
     </p>

      <p>
            <?php echo lang('register_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($output['first_name']);?>
      </p>

      <p>
            <?php echo lang('register_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($output['last_name']);?>
      </p>

      <p>
            <?php echo lang('register_user_email_label', 'email');?> <br />
            <?php echo form_input($output['email']);?>
      </p>
      <p>
            <?php echo lang('register_user_password_label', 'password');?> <br />
            <?php echo form_input($output['password']);?>
      </p>

      <p>
            <?php echo lang('register_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($output['password_confirm']);?>
      </p>


      <p><?php echo form_submit('submit', lang('register_user_submit_btn'));?></p>

<?php echo form_close();?>
