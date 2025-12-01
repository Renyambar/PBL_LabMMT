<?php
class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = $this->model('User');
    }

    // Show login form
    public function login()
    {
        // Redirect if already logged in
        if ($this->isLoggedIn()) {
            $this->redirect('admin');
            return;
        }

        $data = [
            'title' => 'Login - ' . APP_NAME
        ];

        $this->view('auth/login', $data);
    }

    // Process login
    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->login($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                $this->redirect('admin/dashboard');
            } else {
                $_SESSION['error'] = 'Email atau password salah!';
                $this->redirect('auth/login');
            }
        } else {
            $this->redirect('auth/login');
        }
    }

    

    // Logout
    public function logout()
    {
        session_destroy();
        $this->redirect('home');
    }

    // Show register form (optional)
    public function register()
    {
        $data = [
            'title' => 'Register - ' . APP_NAME
        ];

        $this->view('auth/register', $data);
    }

    // Process registration
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'role' => 'editor'
            ];

            // Validate password confirmation
            if ($_POST['password'] !== $_POST['password_confirm']) {
                $_SESSION['error'] = 'Password tidak cocok!';
                $this->redirect('auth/register');
                return;
            }

            if ($this->userModel->create($data)) {
                $_SESSION['message'] = 'Registrasi berhasil! Silakan login.';
                $this->redirect('auth/login');
            } else {
                $_SESSION['error'] = 'Registrasi gagal!';
                $this->redirect('auth/register');
            }
        }
    }
}
