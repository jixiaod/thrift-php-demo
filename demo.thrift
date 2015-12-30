namespace php demo 

struct User
{
    1:i32 uid,
    2:string name,
    3:i32 age
}

service Foo
{
    User getUserInfo(1:i32 uid),
}
