<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Proposal</title>
    <link src="{{ asset('css/pdf.min.css')}}" rel="stylesheet">
</head>

<body>
    <header class="clearfix">
        <div style="text-align:center;">
            <img src="{{ base_path() }}/public/img/task4it-contract-logo.png" height="150px">
            <h3><b>SERVICES PRE CONTRACT</b></h3>
        </div>
        <div id="company">
            
        </div>
    </header>
    <main>
    <p style="text-align: justify;text-justify: inter-word;">
    Celebrated between the CONTRACTOR - Dreamers & Heroes, Unipessoal, LDA, VAT ID
    Number (VAT) 513805168, with head office at Rua Ary dos Santos no 5 - 2o Esquerdo,
    2925-061 Azeitão - Portugal, represented by the manager Mário Ribeiro Inês da Silva and
    the CONTRACTING PART – {{$proposal->company}} – Represented by {{$proposal->owner}} <br>
    It is agreed and reduced in writing to this Service Agreement, under the terms and subject
    to the following clauses:
    </p>
    <h3><b>1 - OBJECT OF THE CONTRACT</b></h3>
    <p style="text-align: justify;text-justify: inter-word;">
    The purpose of this contract is to create {{$proposal->object}}
    , here simply referred to as "SITE" or "WEB SITE", for exclusive use on the
    Internet, with institutional references of the CONTRACTING PART, demonstrating its
    products, services and technology. Including also the provision of service regarding the
    maintenance of this "SITE" for the duration mentioned below.
    </p>
    <h3><b>2 - OBLIGATIONS</b></h3>
    <h3>2.1 - THE CONTRACTOR'S OBLIGATIONS</h3>
    <p style="text-align: justify;text-justify: inter-word;">
    The CONTRACTOR undertakes to develop the object of this contract in the most adequate
    and dynamic manner, developing all the functions intended by the CONTRACTING PART.
    The following services are also performed by the CONTRACTOR:
    </p>
    <br>
    <b>Team:</b>
    <br>
    <br>
    @foreach(unserialize($proposal->team) as $position=>$name)
        {{$position}} – {{$name}} <br><br>
    @endforeach
    <h3>2.2 - THE CONTRACTOR'S OBLIGATIONS</h3>
    <p style="text-align: justify;text-justify: inter-word;">
    The CONTRACTING PART will be responsible for the delivery of all the necessary material
    for carrying out the works, such as:
    </p>
    <br>
    - Contents to be included in the "WEBSITE".
    <br>
    <br>
    <p style="text-align: justify;text-justify: inter-word;">
    The CONTRACTING PART must correctly make the payments to the CONTRACTED,
    according to item 4.
    </p>
    <h3>2.3 – COMMUNICATION</h3>
    <p style="text-align: justify;text-justify: inter-word;">
    The communication between the CONTRACTOR PART and CONTRACTING PART will be
    attending several tools combined, such as: Skype, Slack , Task4IT Manager / Internal
    Issue Tracker Tool and GitHub - where it will be exposed the project code.
    </p>
    <h3><b>3 - SERVICES MAINTENANCE</b></h3>
    <p style="text-align: justify;text-justify: inter-word;">
    The CONTRACTOR shall, through the maintenance of the services, maintain the WEBSITE
    in the better web navigation condition, making the necessary adjustments, configurations
    and repairs in front or Backend.
    </p>
    <b>A)</b> Only the CONTRACTOR's technicians may perform preventive and corrective technical
    services, to which this clause refers. <br><br>
    <b>B)</b> The maintenance of the services contracted here does not include: <br><br>
    <div style="padding-left:5em;">
    - Services additional to those mentioned in this contract; <br>
    - Elaboration and construction of extra databases;<br>
    - Creation of extra modules regarding the discussed between the parts.<br>
    - Future problems resulting from third party security updates.<br>
    - Problems that are not directly linked to Dreamers & Heroes, Unipessoal, LDA.<br>
    </div>
    <br>
    <b>C)</b> The CONTRACTED PARTY undertakes to make the Setup, Installation and
    configuration of the "WEBSITE" of the CONTRACTING PARTY in order to become
    operational and operate in full production.
    <br>
    <br>

    <h3><b>4 – PRICE AND DELIVERY DATES</b></h3>
    <p style="text-align: justify;text-justify: inter-word;">
    For the services of construction, maintenance and guarantee of "WEBSITE", object of this
    contract, will have the value of: <br>
    </p>
    <div style="padding-left:5em;">
    –Web Development: {{$proposal->webdev}}
    <br>
    <br>
    –Timeline: {{$proposal->timeline}}
    <br>
    <br>
    </div>
    Milestones:
    <br>
    <br>
    <div style="padding-left:2em;">
    @foreach(unserialize($proposal->milestones) as $key => $milestone)
    <b>#{{$key+1}}</b> – {{$milestone}} <br>
    @endforeach
    <br>
    </div>
    <p style="text-align: justify;text-justify: inter-word;">
    Technical support: 6 months after the final delivery of the project for technical issues
    related with bugs/issues found in {{$proposal->name}}. <br>
    </p>

    <h3><b>5 - FORM OF PAYMENT</b></h3>
    <p style="text-align: justify;text-justify: inter-word;">
    The form of payment to be used is by Bank Transfer to the Account Number of the
    company, indicated below: <br><br>
    IBAN - PT50 0035 0275 00029494830 52 <br><br>
    BIC SWIFT – CGDIPTPL <br><br>
    Company: Dreamers & Heroes, Unipessoal Lda <br><br>
    Rua Ary dos Santos, no 5 – 2o Esquerdo <br><br>
    2925-061 Brejos de Azeitão - Portugal <br><br>
    Vat ID: 513805168 <br><br>
    European VAT Validation: http://ec.europa.eu/taxation_customs/vies/vatResponse.html <br><br>
    </p>
    <h3><b>6 - TERMINATION OF THE CONTRACT</b></h3>
    <b>A)</b> This contract may be terminated by the CONTRACTOR, without any charge, when: <br><br>
    - The CONTRACTED PARTY does not perform the services requested by the
    CONTRACTING PARTY, and that they are in agreement with the clauses of this contract.<br><br>
    - When the CONTRACTOR does not comply with any of the clauses of this contract.<br><br>
    <b>B)</b> This contract may be terminated by the CONTRACTOR when:<br><br>
    - The CONTRACTING PARTY in the event of breach of the obligations assumed herein, and
    the innocent party must notify the guilty party to remedy its failure within 30 days, after
    which, the debt will not be remedied, the CONTRACTED PARTY shall not perform any typeof work to the CONTRACTING PARTY.<br><br>
    <b>C)</b> In case of judicial litigation, the court competent to settle the conflict will be the judicial
    Court of the Setubal District – Portugal. <br><br>

    <h3><b>7 - TERMINATION OF THE AGREEMENT</b></h3>
    <p style="text-align: justify;text-justify: inter-word;">
    This contract will be in force for a fixed term of {{$proposal->lenght}}.
    </p>
    <p style="text-align: justify;text-justify: inter-word;">
    The present contract will be printed twice having both same content and form, being
    signed by both parts as sign of agreement with all the display context.
    <br>
    <br>
    Lisbon, {{$proposal->date}}
    <br>
    <br>
    <br>
    CONTRACTED
    <br>
    <br>
    <br>
    <hr style="width:10em; margin-left:-1px;">
    <br>
    CONTRACTOR
    <br>
    <br>
    <br>
    <hr style="width:10em; margin-left:-1px;">

    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>