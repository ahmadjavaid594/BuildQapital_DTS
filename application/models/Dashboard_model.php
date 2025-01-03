<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getMonthlyBookIssued($id = '')
    {
        $this->db->select('id');
        $this->db->from('leave_application');
        $this->db->where("start_date BETWEEN DATE_SUB(CURDATE() ,INTERVAL 1 MONTH) AND CURDATE() AND status = '2' AND role_id = '7' AND user_id = " . $this->db->escape($id));
        return $this->db->get()->num_rows();
    }

    public function getStaffCounter($role='', $branchID = '')
    {
        $this->db->select('count(staff.id) as snumber');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id', 'inner');
        $this->db->where_not_in('login_credential.role', 1);
        if (!empty($role)) {
            $this->db->where('login_credential.role', $role);
        }else{
            $this->db->where_not_in('login_credential.role', array(1,3,6,7));
        }
        if (!empty($branchID)) {
            $this->db->where('staff.branch_id', $branchID);
        }
        return $this->db->get()->row_array();
    }

    public function getMonthlyPayment($id = '')
    {
        $this->db->select('IFNULL(sum(h.amount),0) as amount');
        $this->db->from('fee_allocation as fa');
        $this->db->join('fee_payment_history as h', 'h.allocation_id = fa.id', 'left');
        $this->db->where("h.date BETWEEN DATE_SUB(CURDATE(),INTERVAL 1 MONTH) AND CURDATE() AND fa.student_id = " . $this->db->escape($id) . " AND fa.session_id = " . $this->db->escape(get_session_id()));
        return $this->db->get()->row()->amount;
    }

    /* annual academic fees summary charts */
    public function annualFeessummaryCharts($branchID = '', $studentID = '')
    {
        $total_fee = array();
        $total_paid = array();
        $total_due = array();
        for ($month = 1; $month <= 12; $month++) {
            $sql = "SELECT IFNULL(SUM(gd.amount), 0) as total_amount,(SELECT SUM(h.amount) FROM fee_payment_history as h where h.allocation_id = fa.id and h.type_id = gd.fee_type_id) as total_paid,(SELECT SUM(h.discount) FROM fee_payment_history as h where h.allocation_id = fa.id and h.type_id = gd.fee_type_id) as total_discount FROM fee_allocation as fa INNER JOIN fee_groups_details as gd ON gd.fee_groups_id = fa.group_id WHERE MONTH(gd.due_date) = " . $this->db->escape($month) . " AND YEAR(gd.due_date) = YEAR(CURDATE()) AND fa.session_id = " . $this->db->escape(get_session_id());
            if (!empty($branchID))
               $sql .= " AND fa.branch_id = " . $this->db->escape($branchID);
            if (!empty($studentID))
               $sql .= " AND fa.student_id = " . $this->db->escape($studentID);
            $row = $this->db->query($sql)->row();
            $total_fee[] = floatval($row->total_amount);
            $total_paid[] = floatval($row->total_paid);
            $total_due[] = floatval($row->total_amount - ($row->total_paid + $row->total_discount));
        };
        return array(
            'total_fee' => $total_fee,
            'total_paid' => $total_paid,
            'total_due' => $total_due,
        );
    }

    /* student annual attendance charts */
    public function getStudentAttendance($studentID = '')
    {
        $total_present = array();
        $total_absent = array();
        $total_late = array();
        for ($month = 1; $month <= 12; $month++):
            $total_present[] = $this->db->query("SELECT id FROM student_attendance WHERE MONTH(date) = " . $this->db->escape($month) . " AND YEAR(date) = YEAR(CURDATE()) AND status = 'P' AND student_id = " . $this->db->escape($studentID))->num_rows();
            $total_absent[] = $this->db->query("SELECT id FROM student_attendance WHERE MONTH(date) = " . $this->db->escape($month) . " AND YEAR(date) = YEAR(CURDATE()) AND status = 'A' AND student_id = " . $this->db->escape($studentID))->num_rows();
            $total_late[] = $this->db->query("SELECT id FROM student_attendance WHERE MONTH(date) = " . $this->db->escape($month) . " AND YEAR(date) = YEAR(CURDATE()) AND status = 'L' AND student_id = " . $this->db->escape($studentID))->num_rows();
        endfor;
        return array(
            'total_present' => $total_present,
            'total_absent' => $total_absent,
            'total_late' => $total_late,
        );
    }

    public function get_monthly_attachments($id = '')
    {
        $branchID = get_loggedin_branch_id();
        $classID = $this->db->select('class_id')->where('student_id', $id)->get('enroll')->row()->class_id;
        $this->db->select('id');
        $this->db->from('attachments');
        $this->db->where("date BETWEEN DATE_SUB(CURDATE() ,INTERVAL 1 MONTH) AND CURDATE() AND (class_id = " . $this->db->escape($classID) . " OR class_id = 'unfiltered') AND branch_id = " . $this->db->escape($branchID));
        return $this->db->get()->num_rows();
    }


    public function getDailyBranchWiseAttendance($branchID = '')
    {
        $branch_name = array();
        $total_students = array();
        $present = array();
        $holiday = array();
        $late = array();
        $absent = array();
        $query = "select SUM(a.total_students) as total_students, SUM(a.present) as present, SUM(a.absent) as absent, SUM(a.holiday) holiday, SUM(a.late) as late, a.branch_name from(
select count(DISTINCT a.student_id) as total_students,(case a.status when 'P' then count(DISTINCT a.student_id) else 0 end) as present,(case a.status when 'A' then count(DISTINCT a.student_id) else 0 end) as absent,(case a.status when 'H' then count(DISTINCT a.student_id) else 0 end) as holiday,(case a.status when 'L' then count(DISTINCT a.student_id) else 0 end) as late, b.name as branch_name  from student_attendance a inner join branch b on a.branch_id = b.id
where a.date = CURRENT_DATE GROUP by b.name, a.status
) a  group by a.branch_name";
$results =  $this->db->query($query)->result_array();
foreach ($results as $res) {
    $branch_name[] = $res['branch_name'];
    $total_students[]['y'] = $res['total_students'];
    $present[]['y'] = $res['present'];
    $absent[]['y'] = $res['absent'];
    $holiday[]['y'] = $res['holiday'];
    $late[]['y'] = $res['late'];

    }
    return array(
        'branch_name' => $branch_name,
        'total_students' => $total_students,
        'present' => $present,
        'absent' => $absent,
        'holiday' => $holiday,
        'late' => $late
    );
        
    }
    /* annual academic fees summary charts */
    public function getWeekendAttendance($branchID = '')
    {
        $days = array();
        $employee_att = array();
        $student_att = array();
        $now = new DateTime("6 days ago");
        $interval = new DateInterval('P1D'); // 1 Day interval
        $period = new DatePeriod($now, $interval, 6); // 7 Days
        foreach ($period as $day) {
            $days[] = $day->format("d-M");
            $this->db->select('id');
            if (!empty($branchID)) {
                $this->db->where('branch_id', $branchID);
            }

            $this->db->where('date = "' . $day->format('Y-m-d') . '" AND (status = "P" OR status = "L")');
            $student_att[]['y'] = $this->db->get('student_attendance')->num_rows();

            $this->db->select('id');
            if (!empty($branchID)) {
                $this->db->where('branch_id', $branchID);
            }

            $this->db->where('date = "' . $day->format('Y-m-d') . '" AND (status = "P" OR status = "L")');
            $employee_att[]['y'] = $this->db->get('staff_attendance')->num_rows();
        }
        return array(
            'days' => $days,
            'employee_att' => $employee_att,
            'student_att' => $student_att,
        );
    }
    public function getMonthlyAttendance($branchID = '')
    {
        $days = array();
        $employee_att = array();
        $student_att = array();
        $now = new DateTime("30 days ago");
        $interval = new DateInterval('P1D'); // 1 Day interval
        $period = new DatePeriod($now, $interval, 30); // 7 Days
        foreach ($period as $day) {
            $days[] = $day->format("d-M");
            $this->db->select('id');
            if (!empty($branchID)) {
                $this->db->where('branch_id', $branchID);
            }

            $this->db->where('date = "' . $day->format('Y-m-d') . '" AND (status = "P" OR status = "L")');
            $student_att[]['y'] = $this->db->get('student_attendance')->num_rows();

            $this->db->select('id');
            if (!empty($branchID)) {
                $this->db->where('branch_id', $branchID);
            }

            $this->db->where('date = "' . $day->format('Y-m-d') . '" AND (status = "P" OR status = "L")');
            $employee_att[]['y'] = $this->db->get('staff_attendance')->num_rows();
        }
        return array(
            'days' => $days,
            'employee_att' => $employee_att,
            'student_att' => $student_att,
        );
    }
   /* public function getDailyBranchWiseAttendance($branchID = '')
    {
        $query = "select SUM(a.total_students) as total_students, SUM(a.present) as present, SUM(a.absent) as absent, SUM(a.holiday) holiday, SUM(a.late) as late, a.branch_name from(
select count(DISTINCT a.student_id) as total_students,(case a.status when 'P' then count(DISTINCT a.student_id) else 0 end) as present,(case a.status when 'A' then count(DISTINCT a.student_id) else 0 end) as absent,(case a.status when 'H' then count(DISTINCT a.student_id) else 0 end) as holiday,(case a.status when 'L' then count(DISTINCT a.student_id) else 0 end) as late, b.name as branch_name  from student_attendance a inner join branch b on a.branch_id = b.id
where a.date = CURRENT_DATE GROUP by b.name, a.status
) a  group by a.branch_name";
$results =  $this->db->query($sql)->result_array();

       return $results;
        
    }*/
    /* monthly academic cash book transaction charts */
    public function getIncomeVsExpense($branchID = '')
    {
        $query = 'SELECT IFNULL(SUM(dr),0) as dr, IFNULL(SUM(cr),0) as cr FROM transactions WHERE month(DATE) = MONTH(now()) AND year(DATE) = YEAR(now())';
        if (!empty($branchID)) {
            $query .= " AND branch_id = " . $this->db->escape($branchID);
        }
        $r = $this->db->query($query)->row_array();
        return array(['name' => translate("expense"), 'value' => $r['dr']], ['name' => translate("income"), 'value' => $r['cr']]);
    }

    public function getApplicantsSummary()
    {
        $query = 'select sum(y.count) counts, y.name, sum(y.paid) challans, sum(y.jobs) as total_jobs from (
SELECT count(a.id) count, c.name, 0 as paid, 0 as jobs  FROM job_applicants a inner join job b on a.job_id = b.id inner join organization c on b.organization_id = c.id group by c.name
UNION all
SELECT 0 count, c.name, count(a.id) as paid, 0 as jobs  FROM job_applicants a inner join job b on a.job_id = b.id inner join organization c on b.organization_id = c.id where a.status_id = 16 group by c.name
UNION all
SELECT 0 count, c.name, 0 as paid, count(b.id) as jobs  FROM job b inner join organization c on b.organization_id = c.id group by c.name) y group by y.name';
        $res = $this->db->query($query)->result();
        return $res;
    }
    /* total academic students strength classes divided into charts */
    public function getStudentByClass($branchID = '')
    {
        $this->db->select('IFNULL(COUNT(e.student_id), 0) as total_student, c.name as class_name');
        $this->db->from('enroll as e');
        $this->db->join('class as c', 'c.id = e.class_id', 'inner');
        $this->db->group_by('e.class_id');
        if (!empty($branchID)) {
            $this->db->where('e.branch_id', $branchID);
        }

        $query = $this->db->get();
        $data = array();
        if ($query->num_rows() > 0) {
            $students = $query->result();
            foreach ($students as $row) {
                $data[] = ['value' => floatval($row->total_student), 'name' => $row->class_name];
            }
        } else {
            $data[] = ['value' => 0, 'name' => translate('not_found_anything')];
        }
        return $data;
    }

    public function get_all_jobs()
    {
        return $this->db->get('job')->num_rows();
    }
    public function get_all_users()
    {
        return $this->db->get('applicants')->num_rows();
    }
    public function get_all_organizations()
    {
        return $this->db->get('organization')->num_rows();
    }
    public function get_all_qoutas()
    {
        return $this->db->get('qouta')->num_rows();
    }
    public function get_all_job_types()
    {
        return $this->db->get('job_type')->num_rows();
    }
    public function get_all_locations()
    {
        return $this->db->get('location')->num_rows();
    }
    public function get_all_designations()
    {
        return $this->db->get('designation')->num_rows();
    }
    public function get_all_active_jobs()
    {
        $this->db->select('id');
        $this->db->where('is_active', 1);
        return $this->db->get('job')->num_rows();
    }
    public function get_all_inactive_jobs()
    {
        $this->db->select('id');
        $this->db->where('ifnull(is_active,0)', 0);
        return $this->db->get('job')->num_rows();
    }
    public function get_all_applications()
    {
       
        return $this->db->get('job_applicants')->num_rows();
    }
      public function get_total_challans_paid()
    {
        $this->db->select('id');
        $this->db->where('status_id', 16);
        return $this->db->get('job_applicants')->num_rows();
    }
    public function get_total_student($branchID = '')
    {
        $this->db->select('id');
        if (!empty($branchID))
            $this->db->where('branch_id', $branchID);
        return $this->db->get('enroll')->num_rows();
    }

    public function get_all_applied_jobs()
    {
        $applicant_id = get_loggedin_user_id();
        $this->db->select('id');
        $this->db->where('applicant_id', $applicant_id);
        return $this->db->get('job_applicants')->num_rows();
    }
    public function get_all_shortlisted_jobs()
    {
        $applicant_id = get_loggedin_user_id();
        $this->db->select('id');
        $this->db->where('applicant_id', $applicant_id);
        $this->db->where('status_id', 10);
        return $this->db->get('job_applicants')->num_rows();
    }
    public function get_all_rejected_jobs()
    {
        $applicant_id = get_loggedin_user_id();
        $this->db->select('id');
        $this->db->where('applicant_id', $applicant_id);
        $this->db->where('status_id', 11);
        return $this->db->get('job_applicants')->num_rows();
    }
    public function get_all_pending_challans()
    {
        $applicant_id = get_loggedin_user_id();
        $this->db->select('id');
        $this->db->where('applicant_id', $applicant_id);
        $this->db->where('status_id', 9);
        return $this->db->get('job_applicants')->num_rows();
    }
    public function getMonthlyAdmission($branchID = '')
    {
        $this->db->select('s.id');
        $this->db->from('student as s');
        $this->db->join('enroll as e', 'e.student_id = s.id', 'inner');
        $this->db->where('s.admission_date BETWEEN DATE_SUB(CURDATE() ,INTERVAL 1 MONTH) AND CURDATE()');
        if (!empty($branchID)) {
            $this->db->where('e.branch_id', $branchID);
        }
        return $this->db->get()->num_rows();
    }

    public function getVoucher($branchID = '')
    {
        $this->db->select('id');
        if (!empty($branchID)) {
            $this->db->where('branch_id', $branchID);
        }
        $this->db->where('date BETWEEN DATE_SUB(CURDATE() ,INTERVAL 1 MONTH) AND CURDATE()');
        return $this->db->get('transactions')->num_rows();
    }

    public function get_transport_route($branchID = '')
    {
        if (!empty($branchID)) {
            $this->db->where('branch_id', $branchID);
        }
        return $this->db->get('transport_route')->num_rows();
    }
}
