import Error from "./Error";

interface Permission {
    id: number,
    name: string
}

interface User {
    name: string,
    email: string,
    email_verified_at: string,
    effectivePermissions: string[],
    permissions: Permission[],
    created_at: string,
    updated_at: string
}

export default User;

/**
 * Gets the currently logged-in user.
 */
export async function getCurrentUser(): Promise<User|Error> {
    let x = await window.axios.get('/api/user');
    return x.data;
}

export async function login(email: string, password: string): Promise<User|null> {
    try {
        await window.axios.post('/login', {email, password});
    } catch(e) {
        return null;
    }
    return <User>(await getCurrentUser());
}

export async function logout(): Promise<void> {
    await window.axios.post('/logout');
}

export async function getAllUsers(): Promise<User> {
    let x = await window.axios.get('/api/users');
    return x.data;
}

export async function getUser(id: number): Promise<User> {
    let x = await window.axios.get('/api/users/' + encodeURIComponent(id));
    return x.data;
}

export const AVAILABLE_PERMISSIONS = [
    "view admin panel",
    "modify standard settings",
    "modify discord settings",
    "modify users",
    "modify departments",
    "view audit logs",

    "access dispatch dashboard",
    "access leo dashboard",
    "access civilian dashboard",
    "lookup civilian records"
];
