import Error from "./Error";

interface User {
    name: string,
    email: string,
    email_verified_at: string,
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
