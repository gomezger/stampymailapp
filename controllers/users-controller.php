<?php

include_once 'controllers/session-controller.php';
include_once 'helpers/validate.php';

class UsersController extends SessionController
{

    function __construct()
    {
        parent::__construct();
    }

    function default(array $params = []): void
    {
        $params['users'] = $this->loadModel('user')->all();
        $this->view->render('users/table', 'StampyMailApp | Usuarios', ['users.css'], [], $params);
    }

    function form(array $params = []): void
    {
        // si existe params, es que hay error
        $errors = (isset($params[0])) ? json_decode(Encryption::decrypt($params[0])) : [];
        $this->view->render('users/form', 'StampyMailApp | Crear usuario', ['form-user.css'], [], ["errors" => $errors]);
    }

    function formUpdate(array $params = []): void
    {
        $userid = (isset($params[0])) ? Encryption::decrypt($params[0]) : null;
        $errors = (isset($params[1])) ? json_decode(Encryption::decrypt($params[1])) : [];

        if (is_null($userid)) {
            $this->default();
        } else {
            $user = $this->loadModel('user');

            if ($user->find($userid)) {
                $this->view->render('users/form-update', 'StampyMailApp | Editar usuario', ['form-user.css'], [], ["errors" => $errors, "user" => $user]);
            } else {
                $this->default();
            }
        }
    }

    function formPassword(array $params = []): void
    {
        $userid = (isset($params[0])) ? Encryption::decrypt($params[0]) : null;
        $errors = (isset($params[1])) ? json_decode(Encryption::decrypt($params[1])) : [];

        if (is_null($userid)) {
            $this->default();
        } else {
            $user = $this->loadModel('user');

            if ($user->find($userid)) {
                $this->view->render('users/form-password', 'StampyMailApp | Editar contraseña', ['form-user.css'], [], ["errors" => $errors, "user" => $user]);
            } else {
                $this->default();
            }
        }
    }

    function create(): void
    {
        $data = $this->allPost();
        $errors = Validate::required($data, ['username', 'name', 'password']);

        if (count($errors) > 0) {
            $errors = Encryption::encrypt(json_encode($errors));
            $this->redirect('users/form/' . $errors);
        } else {
            $user = $this->loadModel('user');
            $user->set($data, true);

            if($user->exists($user->getUsername())){
                $this->redirect('users/form/' . Encryption::encrypt(json_encode(['Ya existe un usuario con ese nombre de usuario'])));
            }else {
                ($user->insert())
                    ? $this->redirect('users')
                    : $this->redirect('users/form/' . Encryption::encrypt(json_encode(['Error al agregar el usuario'])));
            }

        }
    }

    function update($params = []): void
    {
        $userid = (isset($params[0])) ? Encryption::decrypt($params[0]) : null;

        $data = $this->allPost();
        $errors = Validate::required($data, ['username', 'name']);

        if (count($errors) > 0) {
            $errors = Encryption::encrypt(json_encode($errors));
            $this->redirect('users/form/' . $errors);
        } else {
            $user = $this->loadModel('user');

            if ($user->find($userid)) {
                $user->set($data);

                $user->update()
                    ? $this->redirect('users', [])
                    : $this->redirect('users/formUpdate/' . Encryption::encrypt(json_encode(['Error al editar el usuario'])));
            } else {
                $this->default();
            }
        }
    }

    function updatePassword($params = []): void
    {
        $userid = (isset($params[0])) ? Encryption::decrypt($params[0]) : null;

        $data = $this->allPost();
        $errors = Validate::required($data, ['password_actual', 'password_nueva']);

        if (count($errors) > 0) {
            $errors = Encryption::encrypt(json_encode($errors));
            $this->redirect('users/formPassword/' . Encryption::encrypt($userid) . '/' . $errors);
        } else {
            $user = $this->loadModel('user');

            if (!$user->passwordVerify($data['password_actual'], $userid)) {
                $this->redirect('users/formPassword/' . Encryption::encrypt($userid) . '/' . Encryption::encrypt(json_encode(['Contraseña actual incorrecta'])));
            } else {
                $user = $user->find($userid);
                $user->setPassword($data['password_nueva']);
                $user->update()
                    ? $this->redirect('users', [])
                    : $this->redirect('users/formPassword/' . Encryption::encrypt($userid) . '/' . Encryption::encrypt(json_encode(['Error al editar el usuario'])));
            }
        }
    }

    function delete($params = []): void
    {
        $userid = (isset($params[0])) ? Encryption::decrypt($params[0]) : null;

        $user = $this->loadModel('user');
        if ($user->find($userid)) {

            $user->delete($userid);
            $this->redirect('users', []);
        } else {
            $this->default();
        }
    }

    function logout()
    {
        parent::logout();
    }
}
