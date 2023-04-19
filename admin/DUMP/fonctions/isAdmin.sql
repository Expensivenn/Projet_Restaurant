create or replace function isAdmin(text,text) returns boolean
    as
    '
    declare p_login alias for $1
    declare p_password alias for $2
    declare id integer;
    declare retour boolean;
    begin
        select into id id_admin from admin where login = p_login and password = p_password;
        if not found
            retour = false;
        else
            retour = true;
        end if;
            return retour;
    end;
      '
    language = plpgsql;
