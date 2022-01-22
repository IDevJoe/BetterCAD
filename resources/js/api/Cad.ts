export async function getCadState() {
    let res = await window.axios.get('/api/cad/state');
    return res.data;
}

export async function setIdentifier(newid: string) {
    await window.axios.patch('/api/cad/identifier', {identifier: newid});
}

export async function setStatus(newstatus: string) {
    await window.axios.patch('/api/cad/status', {status: newstatus});
}
