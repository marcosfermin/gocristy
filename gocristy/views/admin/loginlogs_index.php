<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i><span class="glyphicon glyphicon-stats"></span></i> <?php echo  $this->lang->line('loginlogs_header') ?>
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="h2 sub-header"><?php echo $this->lang->line('loginlogs_header') ?></div>
        <form action="<?php echo $this->GoCristy_model->base_link(). '/admin/loginlogs/'; ?>" method="get">
            <div class="control-group">
                <label class="control-label" for="search"><?php echo $this->lang->line('search'); ?>: <input type="text" name="search" id="search" class="input-sm" value="<?php echo $this->input->get('search');?>"></label>
                <label class="control-label" for="start_date"><?php echo $this->lang->line('startdate_field'); ?>: <input type="text" name="start_date" id="start_date" class="form-datepicker input-sm" value="<?php echo $this->input->get('start_date');?>"></label>
                <label class="control-label" for="end_date"><?php echo $this->lang->line('enddate_field'); ?>: <input type="text" name="end_date" id="end_date" class="form-datepicker input-sm" value="<?php echo $this->input->get('end_date');?>"></label>
                <label class="control-label" for="result"><?php echo $this->lang->line('loginlogs_result'); ?>:
                    <select name="result" id="result">
                        <option value=""><?php echo $this->lang->line('option_all'); ?></option>
                        <option value="CAPTCHA_WRONG"<?php echo ($this->input->get('result') == 'CAPTCHA_WRONG')?' selected="selected"':''?>>CAPTCHA_WRONG</option>
                        <option value="INVALID"<?php echo ($this->input->get('result') == 'INVALID')?' selected="selected"':''?>>INVALID</option>
                        <option value="IP_BANNED"<?php echo ($this->input->get('result') == 'IP_BANNED')?' selected="selected"':''?>>IP_BANNED</option>
                        <option value="SUCCESS"<?php echo ($this->input->get('result') == 'SUCCESS')?' selected="selected"':''?>>SUCCESS</option>
                        <option value="CSRF_INVALID"<?php echo ($this->input->get('result') == 'CSRF_INVALID')?' selected="selected"':''?>>CSRF_INVALID</option>
                    </select>	
                </label> &nbsp;&nbsp;&nbsp; 
                <input type="submit" name="submit" id="submit" class="btn btn-default" value="<?php echo $this->lang->line('search'); ?>">
            </div>
        </form>
        <br><br>
        <?php echo  form_open($this->GoCristy_model->base_link(). '/admin/loginlogs/deleteindexurl'); ?>
        <div class="box box-body table-responsive no-padding">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="8%" class="text-center" style="vertical-align:middle;"><label><input id="sel-chkbox-all" type="checkbox"> <?php echo  $this->lang->line('btn_delete') ?></label></th>
                        <th width="10%" class="text-center" style="vertical-align:middle;"><?php echo $this->lang->line('id_col_table'); ?></th>
                        <th width="15%" class="text-center"><?php echo $this->lang->line('user_email'); ?></th>
                        <th width="30%" class="text-center"><?php echo $this->lang->line('ip_address'); ?></th>
                        <th width="20%" class="text-center"><?php echo $this->lang->line('bf_note'); ?></th>
                        <th width="17%" class="text-center"><?php echo $this->lang->line('linkstats_dateime'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($login_logs === FALSE) { ?>
                        <tr>
                            <td colspan="6" class="text-center"><span class="h6 error"><?php echo  $this->lang->line('data_notfound') ?></span></td>
                        </tr>                           
                    <?php } else { ?>
                        <?php
                        foreach ($login_logs as $u) {
                            echo '<tr>';
                            echo '<td class="text-center" style="vertical-align:middle;">
                                    <input type="checkbox" name="delR[]" id="delR" class="selall-chkbox" value="'.$u['login_logs_id'].'">
                                </td>';
                            echo '<td class="text-center" style="vertical-align:middle;">'.$u['login_logs_id'].'</td>';
                            if($u['result'] != 'SUCCESS'){
                                $error_rs = '<span class="error">Error! - '.$u['result'].'</span>';
                            }else{
                                $error_rs = '<span class="success">Success!</span>';
                            }
                            echo '<td style="vertical-align:middle;"><b>' . $u['email_login'] . '</b><br>['.$error_rs.']</td>';
                            echo '<td style="vertical-align:middle;"><b>' . $u['ip_address'] . '</b><br><span style="font-style: italic; font-size:12px;">'.$u['user_agent'].'</span></td>';
                            echo '<td class="text-center" style="vertical-align:middle;">' . $u['note'] . '</td>';
                            echo '<td class="text-center" style="vertical-align:middle;">' . $u['timestamp_create'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?php
                $data = array(
                    'name' => 'submit',
                    'id' => 'submit',
                    'class' => 'btn btn-primary',
                    'value' => $this->lang->line('btn_delete'),
                    'onclick' => "return confirm('".$this->lang->line('delete_message')."');",
                );
                echo form_submit($data);
                ?>
            </div>
        </div>
        <?php echo  form_close(); ?><br>
        <?php echo $this->pagination->create_links(); ?> <b><?php echo $this->lang->line('total').' '.$total_row.' '.$this->lang->line('records');?></b>
        <!-- /widget-content -->
    </div>
</div>
