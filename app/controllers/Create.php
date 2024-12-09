<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Create extends Controller {

    protected $createModel;

    public function __construct() { 
        parent::__construct();
        $this->call->model('create_model');
        $this->call->library('form_validation');
        $this->call->library('session');
        $this->call->library('upload');
        $this->call->library('email');
        $this->createModel = new Create_model();
    }
    
    // Registration
    public function register() {
        if ($this->form_validation->submitted()) {
            $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $phone_number = $this->io->post('phone_number');
            $address = $this->io->post('address');
            $email = $this->io->post('email');
            $password = password_hash($this->io->post('password'), PASSWORD_BCRYPT);
            
    
            $this->create_model->register($first_name, $last_name, $phone_number, $address, $email, $password );
            redirect('login');
        }
        $this->call->view('users/register');
    }
    
    public function login() {
        if ($this->form_validation->submitted()) {
            $email = $this->io->post('email');
            $password = $this->io->post('password');
    
            $user = $this->create_model->get_user_by_email($email);
    
            if ($user && password_verify($password, $user['password'])) {
                // Set session
                $this->session->set_userdata('customer_id', $user['customer_id']);
                $this->session->set_userdata('role', $user['role']);
    
                // Debug: Check if session data is set
                var_dump($this->session->userdata('customer_id'));
    
                // Redirect based on role
                if ($user['role'] === 'customer') {
                    redirect('customer');
                } elseif ($user['role'] === 'admin') {
                    redirect('admin');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect('login');
            }
        }
        $this->call->view('users/login');
    }
    

    // Profile method
    public function customer() {
        if ($this->session->userdata('role') !== 'customer') {
            redirect('login');
        }
    
        $customer_id = $this->session->userdata('customer_id');
        $customer_info = $this->create_model->get_customer_by_id($customer_id);
    
        // Get the services array from the model
        $services = $this->create_model->get_services_by_customer_id($customer_id);  // This should now work correctly and return an array of services

        if ($customer_info) {
            // Pass both customer_info and services to the view
            $this->call->view('customer', ['customer_info' => $customer_info, 'services' => $services]);
        } else {
            $this->session->set_flashdata('error', 'Customer not found.');
            redirect('login');
        }
    }

    
    public function update() {
        // Check if the user is logged in as a customer
        if ($this->session->userdata('role') !== 'customer') {
            redirect('login');
        }
    
        $customer_id = $this->session->userdata('customer_id');
    
        // Check if the form is submitted
        if ($this->form_validation->submitted()) {
            $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $phone_number = $this->io->post('phone_number');
            $address = $this->io->post('address');
            $email = $this->io->post('email');
    
            // Update customer info in the database
            $update_status = $this->create_model->update_customer($customer_id, $first_name, $last_name, $phone_number, $address, $email);
    
            if ($update_status) {
                $this->session->set_flashdata('success', 'Your profile has been updated.');
                redirect('customer'); // Redirect to customer profile page after update
            } else {
                $this->session->set_flashdata('error', 'Failed to update your profile. Please try again.');
            }
        }
    
        // Load the customer profile view
        $customer_info = $this->create_model->get_customer_by_id($customer_id);
        $this->call->view('customer', ['customer_info' => $customer_info]);
    }
    
    public function service() {
        // Check if form is submitted
        if ($this->form_validation->submitted()) {
            $customer_id = $this->session->userdata('customer_id'); // Get logged-in user ID
            $service_type = $this->io->post('service_type');
            $special_instructions = $this->io->post('special_instructions');
            $status = 'Pending';  // Default status
            $is_paid = 'Not Paid'; // Default payment status

            $data = array(
                'customer_id' => $customer_id,
                'service_type' => $service_type,
                'special_instructions' => $special_instructions,
                'status' => $status,
                'is_paid' => $is_paid,
            );

            // Save to database
            if ($this->create_model->insert_service($data)) {
                $this->session->set_flashdata('success', 'Service request submitted successfully.');
                redirect('customer');  // Redirect to customer page
            } else {
                $this->session->set_flashdata('error', 'Failed to submit service request.');
                redirect('service');
            }
        }
        $this->call->view('customer/service_form');
    }

    public function get_services_by_customer_id($customer_id) {
        $query = $this->db->table('services')->where('customer_id', $customer_id)->get();
        if (is_object($query)) {
            return $query->getResultArray();
        }
        return [];
    }
    
    public function admin() {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('login'); 
        }
    
        $customers = $this->create_model->get_customers();
        $services = $this->create_model->get_all_services();
        $daily_revenue = $this->create_model->get_daily_revenue();
        $daily_customers = $this->create_model->get_daily_customers(); // Fetch daily customers
        $daily_services = $this->create_model->get_daily_services(); // Fetch daily services
    
        $this->call->view('admin', [
            'customers' => $customers,
            'services' => $services,
            'daily_revenue' => $daily_revenue,
            'daily_customers' => $daily_customers, // Pass to view
            'daily_services' => $daily_services  // Pass to view
        ]);
    }
    

    public function update_service() {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('login'); // Ensure only admins can access this method
        }
    
        if ($this->form_validation->submitted()) {
            $service_id = $this->io->post('service_id');
            $kilo = $this->io->post('kilo');
            $total_amount = $this->io->post('total_amount');
            $is_paid = $this->io->post('paid_status');
            $status = $this->io->post('status');
    
            $data = [
                'kilo' => $kilo,
                'total_amount' => $total_amount,
                'is_paid' => $is_paid,
                'status' => $status
            ];
    
            // Update service in the database
            $updated = $this->create_model->update_service($service_id, $data);
    
            if ($updated) {
                $this->session->set_flashdata('success', 'Service updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update service. Please try again.');
            }
    
            redirect('admin'); // Redirect back to the admin dashboard
        }
    }

    public function print_customers() {
        // Check if the user is an admin
        if ($this->session->userdata('role') !== 'admin') {
            redirect('login');
        }
    
        // Fetch all customers
        $customers = $this->create_model->get_customers();
    
        // Load TCPDF library
        require_once __DIR__ . '/../vendor/autoload.php';
    
        $pdf = new \TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Customer List');
        $pdf->SetHeaderData('', 0, 'Customer List', '');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(15, 27, 15);
        $pdf->SetAutoPageBreak(TRUE, 25);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 10);
    
        // Create the HTML content for the PDF
        $html = '<h2>Customer List</h2>';
        $html .= '<table border="1" cellpadding="5">';
        $html .= '<thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Email</th>
                    </tr>
                  </thead>';
        $html .= '<tbody>';
        foreach ($customers as $customer) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($customer['customer_id'] ?? 'N/A') . '</td>
                        <td>' . htmlspecialchars($customer['last_name'] ?? 'N/A') . '</td>
                        <td>' . htmlspecialchars($customer['first_name'] ?? 'N/A') . '</td>
                        <td>' . htmlspecialchars($customer['phone_number'] ?? 'N/A') . '</td>
                        <td>' . htmlspecialchars($customer['address'] ?? 'N/A') . '</td>
                        <td>' . htmlspecialchars($customer['email'] ?? 'N/A') . '</td>
                      </tr>';
        }
        $html .= '</tbody></table>';
    
        // Write HTML content to PDF
        $pdf->writeHTML($html, true, false, true, false, '');
    
        // Output PDF
        $pdf->Output('Customer_List.pdf', 'I'); // 'I' for inline display
    }
    
    
}

?>
