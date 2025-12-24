export type PermissionData = {
id?: number;
name: string;
guard_name?: string;
roles_count?: number;
created_at?: any | string;
updated_at?: any | string;
};
export type RoleData = {
id?: number;
name: string;
permissions: { [key: number]: string };
permissions_count?: number;
created_at?: any | string;
};
export type UserData = {
id?: number;
name: string;
email: string;
email_verified_at?: any;
password?: string;
two_factor_secret?: string;
two_factor_confirmed_at?: any;
remember_token?: string;
created_at?: any | string;
updated_at?: any | string;
role?: string;
profile_photo_url?: string | null;
};
