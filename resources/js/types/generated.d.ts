declare namespace App.Data {
export type PermissionData = {
name: string;
guardName: string;
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
