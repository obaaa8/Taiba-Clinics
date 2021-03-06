  
  <?php $__env->startSection('content'); ?>
  <?php $__env->startSection('titel','patient'); ?>
  <div class="content">
      <div class="row">
        

        
        <div class="col-md-12 col-md-12">
            <div class="card"  >
                <div  class="text-center">
                  <br>
                    <h4 class="title"><b><?php echo e($patient->patient_name); ?><b></h4>
                      <hr>
                    </div>
                <div class="content">
                <?php echo e(Form::model($patient, array('route' => array('patient.update', $patient->id), 'method' => 'PUT'))); ?>

                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text"  name="patient_name" value="<?php echo e($patient->patient_name); ?>" class="edit form-control border-input" placeholder="name">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="patient_gender" value="<?php echo e($patient->patient_gender); ?>" class="edit form-control border-input">
                                      <option selected value="<?php echo e($patient->patient_gender); ?>"><?php echo e($patient->patient_gender); ?></option>
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPhone">Phone</label>
                                    <input type="phone" name="patient_phone" value="<?php echo e($patient->patient_phone); ?>" class="edit form-control border-input" placeholder="phone">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Blood Group</label>
                                    <select name="patient_blood" value="<?php echo e($patient->patient_blood); ?>" class="edit form-control border-input">
                                      <option selected value="<?php echo e($patient->patient_blood); ?>"><?php echo e($patient->patient_blood); ?></option>
                                      <option value="O−">O−</option>
                                      <option value="O+">O+</option>
                                      <option value="A−">A−</option>
                                      <option value="A+">A+</option>
                                      <option value="B−">B−</option>
                                      <option value="B+">B+</option>
                                      <option value="AB−">AB−</option>
                                      <option value="AB+">AB+</option>
                                    </select>
                                  </div>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-md-8">
                              <div class="form-group">
                                  <label>Address</label>
                                  <input type="text" name="patient_address" value="<?php echo e($patient->patient_address); ?>" class="edit form-control border-input" placeholder="Home Address">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Birthday</label>
                                  <input type="date" name="patient_birthday" value="<?php echo e($patient->patient_birthday); ?>" class="edit form-control border-input">
                              </div>
                          </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Chronic Diseases</label>
                                    <textarea rows="5" name="patient_diseases" class="edit form-control border-input" placeholder="Description"><?php echo e($patient->patient_diseases); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-fill btn-wd" id="toggle-detail" style="display:none;">Update</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                    <div>
                        <a class="edits" href="#" id="toggle-btn" onclick="toggleDetail()">Edit</a>
                        
                      </div>
                </div>
            </div>
        </div>
        
        
        
        
        <div class="col-md-12 col-md-12">
            <div class="card">
            <div class="row">
            <div class="col-md-12">
            <div class="header">
              <h4 class="title">Visits</h4>
            </div>
            <div class="content">
              <div class="input-group col-md-12">
        		      <input type="search" class="light-table-filter" data-table="members_details" placeholder="Quick Filter">
              </div>
              <div class="text-center">
        		  <table class="members_details">
          			<thead>
          				<tr>
                    <th class="date text_align_center"><b>Date</b></th>
                    <th class="day text_align_center"><b>Day</b></th>
                    <th class="time text_align_center"><b>Time</b></th>
          					<th class="doctor text_align_center"><b>Doctor</b></th>
          					<th class="visit_value text_align_center"><b>Visit_value</b></th>
                    <th class="visit_pid text_align_center"><b>Visit_pid</b></th>
          				</tr>
          			</thead>
          			<tbody>
                
                <?php $__currentLoopData = $visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
          			<tr>
          				<td class="date">
                    <a href="<?php echo e(url ('visit/'.$value->id)); ?>" class="" ><?php echo e($value->visit_date); ?></a>
                  </td>
                  <td class="day">
                    <?php
                      $date_stamp = strtotime(date('Y-m-d', strtotime($value->visit_date)));
                      $stamp = date('l', $date_stamp);
                    ?>
                    <?php echo e($stamp); ?>

                  </td>
                  <td class="time">
                    <?php echo e(App\Divisions_time::find($value->divisions_time_id)->time); ?>

                  </td>
                  </td>
                  <td class="doctor">
                    <?php echo e(App\User::find($value->doctor_id)->name); ?>

                  </td>
          				<td class="visit_value text_align_center">
                    <?php echo e($value->visit_price); ?>

                  </td>
                  <td class="visit_pid">
                    <?php echo e($value->visit_paid); ?>

                  </td>
          			</tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
          		</tbody>
        		</table>
          </div>
          </div>
      </div>
    </div>
  
  </div></div></div>
  </div>

  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>