declare namespace App.Data {
export type PermissionData = {
id: string;
name: string;
guard_name: string;
roles_count: string;
created_at: string;
updated_at: string;
};
export type RoleData = {
name: string;
permissions: { [key: number]: string };
};
export type UserData = {
name: string;
email: string;
password?: string;
role?: string;
};
}
