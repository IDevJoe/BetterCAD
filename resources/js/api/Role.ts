interface Role {
    id: number,
    name: string,
    discord_id: string,
    permissions: string[]
}

export async function getAllRoles() : Promise<Role[]> {
    let resp = await window.axios.get('/api/roles');
    return resp.data.data;
}

export async function createRole(name: string) : Promise<Role> {
    let resp = await window.axios.post('/api/roles', {name});
    return resp.data.data;
}

export async function getRole(id: number) : Promise<Role> {
    let resp = await window.axios.get('/api/roles/' + encodeURIComponent(id));
    return resp.data.data;
}

export async function modifyRole(id: number, rid: string) {
    let resp = await window.axios.patch('/api/roles/' + encodeURIComponent(id), {discord_id: rid});
    return resp.data.data;
}

export async function changePermission(id: number, perm: string, en: boolean) {
    let x = await window.axios.request({
        url: '/api/roles/' + encodeURIComponent(id) + '/permissions',
        data: {permission: perm},
        method: (en ? 'PUT' : 'DELETE')
    });
    return x.data.data;
}

export async function deleteRole(id: number) {
    await window.axios.delete('/api/roles/' + encodeURIComponent(id));
}

export default Role;
