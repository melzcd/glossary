-- Table: glossary_gas

-- DROP TABLE glossary_gas;

CREATE TABLE glossary_gas
(
  glossary_id serial NOT NULL,
  glossary_name character(128),
  glossary_full text,
  glossary_cat integer,
  glossary_abc character(11),
  CONSTRAINT glossary_id PRIMARY KEY (glossary_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE glossary_gas
  OWNER TO postgres;