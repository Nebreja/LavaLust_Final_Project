<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Create_model extends Model {

    public function register($first_name, $last_name, $phone_number, $address, $email, $password ) {
        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'address' => $address,
            'email' => $email,
            'password' => $password,
            'role' => 'customer'
        );
        return $this->db->table('customers')->insert($data);
    }
    
    public function get_user_by_email($email) {
        return $this->db->table('customers')->where('email', $email)->get();
    }

    public function get_customer_by_id($customer_id) {
        return $this->db->table('customers')->where('customer_id', $customer_id)->get();
    }
    public function update_customer($customer_id, $first_name, $last_name, $phone_number, $address, $email) {
        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'address' => $address,
            'email' => $email
        );
    
        // Update the customer record in the database
        return $this->db->table('customers')->where('customer_id', $customer_id)->update($data);
    }
    
    public function insert_service($data) {
        return $this->db->table('services')->insert($data);
    }

    public function get_services_by_customer_id($customer_id) {
        return $this->db->table('services')
                        ->where('customer_id', $customer_id)
                        ->get_all(); // Fetch all rows matching the customer ID
    }
    

    public function get_customers() {
        return $this->db->table('customers')
                        ->select('customer_id, last_name, first_name, phone_number, address, email')
                        ->where('role', 'customer')
                        ->get_all();
    }

    public function get_all_services() {
        return $this->db->table('services')
                        ->select('services.*, CONCAT(customers.first_name, " ", customers.last_name) AS customer_name')
                        ->join('customers', 'services.customer_id = customers.customer_id')
                        ->get_all();
    }
    
    public function update_service($service_id, $data) {
        return $this->db->table('services')
                        ->where('service_id', $service_id)
                        ->update($data);
    }

    public function get_daily_revenue() {
        return $this->db->table('services')
                        ->select('DATE(created_at) AS revenue_date, SUM(total_amount) AS total_revenue')
                        ->where('is_paid', 'Paid')
                        ->group_by('DATE(created_at)')
                        ->order_by('revenue_date', 'DESC')
                        ->get_all();
    }

    public function get_daily_services() {
        return $this->db->table('services')
                        ->select('DATE(created_at) AS service_date, COUNT(service_id) AS total_services')
                        ->group_by('DATE(created_at)')
                        ->order_by('service_date', 'DESC')
                        ->get_all();
    }

    public function get_daily_customers() {
        return $this->db->table('customers')
                        ->select('DATE(created_at) AS registration_date, COUNT(customer_id) AS total_customers')
                        ->group_by('DATE(created_at)')
                        ->order_by('registration_date', 'DESC')
                        ->get_all();
    }
    
    
    
    
}
?>
