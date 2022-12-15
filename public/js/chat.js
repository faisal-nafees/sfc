'use strict';
const e = React.createElement;
const BASE_URL = "http://127.0.0.1:8000/api/"

console.log(data)

const { useEffect, Fragment, useState, useRef } = React

//App
const ChatItem = ({ me, item }) => {
    if (me) {
        return (
            <Fragment>
                <div className="d-flex justify-content-between">
                    <p className="small mb-1 text-muted">{item.created_at}</p>
                    <p className="small mb-1">{item.sender.name}</p>
                </div>
                <div className="d-flex flex-row justify-content-end mb-4 pt-1">
                    <div>
                        <p className="small p-2 me-3 mb-3 text-white rounded-3 bg-primary">{item.message}</p>
                    </div>
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                        alt="avatar 1" style={{ width: 45, height: "100%" }} />
                </div>
            </Fragment>
        )
    }

    return (
        <Fragment>
            <div className="d-flex justify-content-between">
                <p className="small mb-1">{item.sender.name}</p>
                <p className="small mb-1 text-muted">{item.created_at}</p>
            </div>
            <div className="d-flex flex-row justify-content-start">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
                    alt="avatar 1" style={{ width: 45, height: "100%" }} />
                <div>
                    <p className="small p-2 ms-3 mb-3 rounded-3" style={{ backgroundColor: "#f5f6f7" }}>{item.message}</p>
                </div>
            </div>
        </Fragment>
    )
}



const Chat = ({ messages, message, setMessage, sendMessage }) => {

    const scrollView = useRef(null);



    useEffect(() => {
        scrollView.current && scrollView.current.scrollIntoView({ behavior: "smooth" })
    }, [messages])
    return (
        <div className="row" >
            <div className="col-md-4 col-lg-4 col-xl-4">

                <div className="card ">
                    <div className="card-header d-flex justify-content-between border-primary border-5 align-items-center p-3"
                    >
                        <h5 className="mb-0">Chat messages </h5>
                    </div>
                    <div className="card-body overflow-scroll" data-mdb-perfect-scrollbar="true"
                        style={{ position: "relative", height: 700 }}>

                        {messages.map((item, index) => {
                            if (item.sender.id == data.usertwo.id) {
                                return (
                                    <ChatItem item={item} key={index} me={true} />)
                            }
                            return (
                                <ChatItem item={item} key={index} />
                            )
                        })}

                        <div ref={scrollView} />
                    </div>
                    <div className="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                        <div className="input-group mb-0">
                            <input value={message} onChange={e => setMessage(e.target.value)} type="text" className="form-control" placeholder="Type message"
                                aria-label="Recipient's username" aria-describedby="button-addon2" />
                            <button onClick={sendMessage} className="btn btn-primary" type="button" id="button-addon2"
                                style={{ paddingTop: ".55rem" }}>
                                Send
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    )
}



const App = () => {

    const [messages, setMessages] = useState([...data.messages]);
    const [message, setMessage] = useState('')

    useEffect(() => {
        Pusher.logToConsole = true;

        var pusher = new Pusher('40036e58bee7eacf118f', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('chat-channel' + data.uuid);
        channel.bind('get-message', function (data) {
            getChats();
        });



    }, []);




    const getChats = () => {
        axios.post(BASE_URL+"get-all-messages-admin",{conv_id:data.uuid})
            .then((response) => {
                console.log(response,"GET ALL CHATS")
                if(response.data && response.data.data && response.data.data.messages)
                setMessages([...response.data.data.messages])
            })
            .catch((err) => {
                console.log(err)
            })
    }



    const sendMessage = () => {
        axios.post(BASE_URL + "send-message-admin", { message, conversation_id: data.uuid ,user_id:data.user_two})
            .then((response) => {
                setMessage("")
                console.log(response.data)
            })
            .catch((err) => {
                console.log(err)
            })
    }


    return (
        <Fragment>
            <Chat messages={messages} message={message} setMessage={setMessage} sendMessage={sendMessage} />

        </Fragment>
    )
}


const domContainer = document.querySelector('#root');
const root = ReactDOM.createRoot(domContainer);
root.render(e(App));
