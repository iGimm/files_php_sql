

CREATE TABLE archivos (
    id        Int Unsigned Not Null Auto_Increment,
    name      VarChar(255) Not Null Default 'Untitled.txt',
    mime      VarChar(50)  Not Null Default 'text/plain',
    size      BigInt Unsigned Not Null Default 0,
    data      MediumBlob      Not Null,
    created   DateTime        Not Null,
    PRIMARY KEY (id)
)

-- Reference
-- http://bytes.com/topic/php/insights/740327-uploading-files-into-mysql-database-using-php